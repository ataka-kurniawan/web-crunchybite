<?php
session_start();

// Cek apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Hapus session untuk keamanan tambahan
    session_unset();
    session_destroy();

    // Redirect ke halaman utama jika tidak punya izin
    header("Location: ../index.php");
    exit;
}

// Regenerasi session untuk keamanan tambahan
session_regenerate_id(true);
?>
