<?php include '../../auth/check_admin.php'; ?>
<?php
include '../config.php';

// Pastikan ID tersedia di URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID tidak valid!'); window.location.href='index.php';</script>";
    exit;
}

$id = intval($_GET['id']);

// Ambil data kategori berdasarkan ID
$query = "SELECT * FROM category WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Jika kategori tidak ditemukan
if (!$data) {
    echo "<script>alert('Kategori tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);

    // Update data kategori
    $update_query = "UPDATE category SET name = '$name' WHERE id = $id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('Kategori berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kategori!'); window.history.back();</script>";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Edit Kategori</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['name']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
