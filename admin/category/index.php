<?php include '../../auth/check_admin.php'; ?>
<?php
include '../config.php';
$query = "SELECT id, name FROM category";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>


<?php include '../includes/header.php' ?>
<div class="container mt-4">
    <h2 class="mb-4">Daftar kategori</h2>
    <a href="add.php" class="btn btn-success mb-3">Kelola Kategori</a>

    <div class="table-responsive"> <!-- Agar tabel tidak melebar di layar kecil -->
        <table class="table table-striped table-sm"> <!-- Tambahkan table-sm -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 5%;">#</th> <!-- Kolom nomor lebih kecil -->
                    <th scope="col" style="width: 40%;">Nama Kategori</th>
                    <th scope="col" style="width: 40%;">Aksi</th> <!-- Kolom aksi cukup luas -->
                </tr>
            </thead>
            <tbody>
                <?php $no=1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td class="text-truncate" style="max-width: 200px;"><?= $row['name'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>


                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../includes/footer.php' ?>