<?php include '../../auth/check_admin.php'; ?>
<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name'])) { // Pastikan input tidak kosong
        $name = htmlspecialchars($_POST['name']);

        $query = "INSERT INTO category(name) VALUES ('$name')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('Kategori berhasil ditambahkan!'); window.location.href='index.php';</script>";
            exit(); // Hentikan eksekusi setelah redirect
        } else {
            echo "<script>alert('Gagal menambahkan kategori!');</script>";
        }
    } else {
        echo "<script>alert('Nama kategori tidak boleh kosong!');</script>";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Tambah Kategori</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama kategori</label>
            <input type="text" class="form-control" id="name" placeholder="Masukkan nama kategori" name="name" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
