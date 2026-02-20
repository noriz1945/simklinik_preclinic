<?php
// recovery.php
// Script untuk menyelamatkan file yang hilang menggunakan git reflog

header('Content-Type: text/plain');

echo "=== GIT RECOVERY MODE ===\n";

// 1. Cek Reflog
// Reflog mencatat semua pergerakan HEAD. Kita cari commit sebelum reset.
echo "Mencari jejak commit terakhir...\n";
$reflog = shell_exec("git reflog 2>&1");
echo $reflog;

echo "\n--------------------------------\n";

// Analisis output
// Kita mencari baris seperti: "HEAD@{1}: commit: Full Backup Simklinik..."
// Atau "HEAD@{1}: reset: moving to origin/main" -> berarti kita harus mundur ke HEAD@{2}

if (preg_match('/([a-f0-9]+) HEAD@\{\d+\}: commit: Full Backup/', $reflog, $matches)) {
    $commit_hash = $matches[1];
    echo "DITEMUKAN COMMIT PENYELAMAT: $commit_hash\n";
    echo "Sedang mencoba mengembalikan file... (Checkout)\n";

    // Checkout ke commit tersebut
    $output = shell_exec("git reset --hard $commit_hash 2>&1");
    echo $output;

    if (strpos($output, 'HEAD is now at') !== false) {
        echo "\nKELIHATANNYA BERHASIL! Silakan cek File Manager Anda.\n";
    }
} else {
    echo "Tidak menemukan commit 'Full Backup' yang jelas.\n";
    echo "Silakan coba lihat daftar reflog di atas,\n";
    echo "Cari kode hash (misal a1b2c3d) di sebelah kiri tulisan 'commit: ...'\n";
    echo "Lalu jalankan manual di Terminal: git reset --hard KODE_HASH\n";
}

echo "\n=== SELESAI ===\n";
?>