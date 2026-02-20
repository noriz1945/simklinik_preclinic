<?php
/**
 * ============================================
 *  cPanel Bridge API for Antigravity
 * ============================================
 * Upload file ini ke cPanel server Anda.
 * File ini menjadi API bridge yang menerima
 * perintah dari client lokal (cpanel-bridge.html).
 *
 * PENTING: Ganti API_KEY sebelum upload!
 * ============================================
 */

// ==================== KONFIGURASI ====================
define('API_KEY', '568a45d51r44e123214ertyu'); // GANTI INI!
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']); // Root directory
define('MAX_UPLOAD', 50 * 1024 * 1024); // 50MB max

// ==================== CORS HEADERS ====================
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-API-Key');
header('Access-Control-Max-Age: 86400');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

header('Content-Type: application/json; charset=utf-8');

// ==================== AUTENTIKASI ====================
function authenticate()
{
    $key = $_SERVER['HTTP_X_API_KEY'] ?? ($_POST['api_key'] ?? '');
    if ($key !== API_KEY) {
        response(false, 'API Key tidak valid', null, 401);
    }
}

// ==================== RESPONSE HELPER ====================
function response($success, $message, $data = null, $code = 200)
{
    http_response_code($code);
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// ==================== PATH HELPER ====================
function safe_path($path)
{
    $path = str_replace(['\\', '..'], ['/', ''], $path);
    $path = trim($path, '/');
    $full = ROOT_DIR . '/' . $path;
    // Pastikan path masih dalam ROOT_DIR
    $real = realpath(dirname($full));
    if ($real === false || strpos($real, realpath(ROOT_DIR)) !== 0) {
        response(false, 'Path tidak valid', null, 403);
    }
    return $full;
}

function relative_path($full_path)
{
    return ltrim(str_replace(realpath(ROOT_DIR), '', realpath($full_path)), '/\\');
}

function format_size($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}

// ==================== AUTHENTICATE ====================
authenticate();

// ==================== ROUTING ====================
$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {

    // ---- List Directory ----
    case 'list':
        $path = $_POST['path'] ?? '';
        $dir = $path ? safe_path($path) : ROOT_DIR;

        if (!is_dir($dir)) {
            response(false, 'Direktori tidak ditemukan');
        }

        $items = scandir($dir);
        $result = [];

        foreach ($items as $item) {
            if ($item === '.' || $item === '..')
                continue;
            $full = $dir . '/' . $item;
            $rel = ($path ? $path . '/' : '') . $item;
            $result[] = [
                'name' => $item,
                'path' => $rel,
                'is_dir' => is_dir($full),
                'size' => is_file($full) ? filesize($full) : 0,
                'size_fmt' => is_file($full) ? format_size(filesize($full)) : '-',
                'ext' => pathinfo($item, PATHINFO_EXTENSION),
                'perms' => substr(sprintf('%o', fileperms($full)), -4),
                'modified' => date('Y-m-d H:i:s', filemtime($full)),
            ];
        }

        // Sort: directories first, then alphabetical
        usort($result, function ($a, $b) {
            if ($a['is_dir'] && !$b['is_dir'])
                return -1;
            if (!$a['is_dir'] && $b['is_dir'])
                return 1;
            return strcasecmp($a['name'], $b['name']);
        });

        response(true, 'OK', [
            'path' => $path,
            'items' => $result,
            'count' => count($result)
        ]);
        break;

    // ---- Read File ----
    case 'read':
        $path = $_POST['path'] ?? '';
        $file = safe_path($path);

        if (!is_file($file)) {
            response(false, 'File tidak ditemukan');
        }

        $content = file_get_contents($file);
        response(true, 'OK', [
            'path' => $path,
            'name' => basename($file),
            'content' => $content,
            'size' => filesize($file),
            'size_fmt' => format_size(filesize($file)),
            'ext' => pathinfo($file, PATHINFO_EXTENSION),
            'perms' => substr(sprintf('%o', fileperms($file)), -4),
            'modified' => date('Y-m-d H:i:s', filemtime($file)),
        ]);
        break;

    // ---- Write/Save File ----
    case 'write':
        $path = $_POST['path'] ?? '';
        $content = $_POST['content'] ?? '';
        $file = safe_path($path);

        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        if (file_put_contents($file, $content) !== false) {
            response(true, 'File berhasil disimpan');
        }
        else {
            response(false, 'Gagal menyimpan file');
        }
        break;

    // ---- Upload File ----
    case 'upload':
        $path = $_POST['path'] ?? '';
        $dir = $path ? safe_path($path) : ROOT_DIR;

        if (!is_dir($dir)) {
            response(false, 'Direktori tujuan tidak ditemukan');
        }

        if (empty($_FILES['file'])) {
            response(false, 'Tidak ada file yang diupload');
        }

        $uploaded = [];
        $files = $_FILES['file'];

        // Handle single or multiple files
        if (is_array($files['name'])) {
            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $dest = $dir . '/' . basename($files['name'][$i]);
                    move_uploaded_file($files['tmp_name'][$i], $dest);
                    $uploaded[] = $files['name'][$i];
                }
            }
        }
        else {
            if ($files['error'] === UPLOAD_ERR_OK) {
                $dest = $dir . '/' . basename($files['name']);
                move_uploaded_file($files['tmp_name'], $dest);
                $uploaded[] = $files['name'];
            }
        }

        response(true, count($uploaded) . ' file berhasil diupload', ['files' => $uploaded]);
        break;

    // ---- Download File ----
    case 'download':
        $path = $_GET['path'] ?? ($_POST['path'] ?? '');
        $file = safe_path($path);

        if (!is_file($file)) {
            response(false, 'File tidak ditemukan');
        }

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        header('Access-Control-Allow-Origin: *');
        readfile($file);
        exit;
        break;

    // ---- Delete ----
    case 'delete':
        $path = $_POST['path'] ?? '';
        $target = safe_path($path);

        if (!file_exists($target)) {
            response(false, 'File/folder tidak ditemukan');
        }

        if (is_dir($target)) {
            // Recursive delete
            $it = new RecursiveDirectoryIterator($target, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $f) {
                $f->isDir() ? rmdir($f->getRealPath()) : unlink($f->getRealPath());
            }
            rmdir($target);
        }
        else {
            unlink($target);
        }

        response(true, 'Berhasil dihapus');
        break;

    // ---- Rename ----
    case 'rename':
        $path = $_POST['path'] ?? '';
        $new_name = $_POST['new_name'] ?? '';
        $old = safe_path($path);

        if (!file_exists($old)) {
            response(false, 'File/folder tidak ditemukan');
        }

        $new = dirname($old) . '/' . basename($new_name);
        if (rename($old, $new)) {
            response(true, 'Berhasil di-rename');
        }
        else {
            response(false, 'Gagal rename');
        }
        break;

    // ---- Create Directory ----
    case 'mkdir':
        $path = $_POST['path'] ?? '';
        $name = $_POST['name'] ?? '';
        $dir = ($path ? safe_path($path) : ROOT_DIR) . '/' . basename($name);

        if (mkdir($dir, 0755, true)) {
            response(true, 'Folder berhasil dibuat');
        }
        else {
            response(false, 'Gagal membuat folder');
        }
        break;

    // ---- Create File ----
    case 'touch':
        $path = $_POST['path'] ?? '';
        $name = $_POST['name'] ?? '';
        $file = ($path ? safe_path($path) : ROOT_DIR) . '/' . basename($name);

        if (file_put_contents($file, '') !== false) {
            response(true, 'File berhasil dibuat');
        }
        else {
            response(false, 'Gagal membuat file');
        }
        break;

    // ---- Server Info ----
    case 'info':
        $disk_free = disk_free_space(ROOT_DIR);
        $disk_total = disk_total_space(ROOT_DIR);
        response(true, 'OK', [
            'php_version' => phpversion(),
            'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'root' => ROOT_DIR,
            'hostname' => gethostname(),
            'disk_free' => format_size($disk_free),
            'disk_total' => format_size($disk_total),
            'disk_used' => format_size($disk_total - $disk_free),
            'disk_percent' => round(($disk_total - $disk_free) / $disk_total * 100, 1),
            'max_upload' => format_size(min(
            (int)ini_get('upload_max_filesize') * 1024 * 1024,
            (int)ini_get('post_max_size') * 1024 * 1024,
            MAX_UPLOAD
        )),
        ]);
        break;

    // ---- Ping/Test ----
    case 'ping':
        response(true, 'Bridge is alive!', [
            'version' => '1.0',
            'time' => date('Y-m-d H:i:s'),
        ]);
        break;

    default:
        response(false, 'Action tidak valid. Gunakan: list, read, write, upload, download, delete, rename, mkdir, touch, info, ping', null, 400);
}
