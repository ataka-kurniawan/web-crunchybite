<?php include '../../auth/check_admin.php'; ?>
<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID hanya angka

    $query = "DELETE FROM category WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Kategori berhasil dihapus!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kategori!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
}
?>
