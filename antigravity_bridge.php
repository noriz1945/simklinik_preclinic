<?php
/**
 * Antigravity Bridge - Secure File Access
 * Token: 4f8a2b9d1c7e6f3a5b0d4e8c9f2a1b7d
 */

$token = "4f8a2b9d1c7e6f3a5b0d4e8c9f2a1b7d";
$headers = getallheaders();

if (!isset($headers['X-Antigravity-Token']) || $headers['X-Antigravity-Token'] !== $token) {
    header('HTTP/1.0 403 Forbidden');
    echo "Access Denied";
    exit;
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'read':
        $path = $_POST['path'] ?? '';
        if (file_exists($path)) {
            echo file_get_contents($path);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "File not found: " . $path;
        }
        break;

    case 'write':
        $path = $_POST['path'] ?? '';
        $content = $_POST['content'] ?? '';
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (file_put_contents($path, $content) !== false) {
            echo "Success";
        } else {
            header('HTTP/1.0 500 Internal Server Error');
            echo "Failed to write file";
        }
        break;

    case 'list':
        $path = $_POST['path'] ?? '.';
        $files = scandir($path);
        echo json_encode($files);
        break;

    case 'test':
        echo "Connected";
        break;

    default:
        header('HTTP/1.0 400 Bad Request');
        echo "Invalid Action";
}
