<?php include '../../auth/check_admin.php'; ?>
<?php
include '../config.php';
if (isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT image FROM product WHERE id = $id";
    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $image_path = "../public/uploads/" . $data['image'];

        // Hapus gambar jika ada
        if (file_exists($image_path) && !empty($data['image'])) {
            unlink($image_path);
        }

        // Hapus produk dari database
        $delete_query = "DELETE FROM product WHERE id = $id";
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('Produk berhasil dihapus!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus produk!'); window.history.back();</script>";
        }
    }
} else {
    echo "<script>alert('ID produk tidak ditemukan!'); window.history.back();</script>";
}
