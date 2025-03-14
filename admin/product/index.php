<?php include '../../auth/check_admin.php'; ?>
<?php
include '../config.php';
$query = "SELECT product.id,
product.name AS product_name,
product.price,
product.stock,
product.description,
category.name AS category_name,
product.image FROM product LEFT JOIN category ON product.category_id = category.id";

$result = mysqli_query($conn, $query);
?>
<?php include '../includes/header.php' ?>
<div class="container mt-4">
    <h2 class="mb-4">Daftar Produk</h2>
    <a href="add.php" class="btn btn-success mb-3">Tambah Produk</a>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Harga</th>
                <th scope="col">Stock</th>
                <th scope="col">gambar</th>
                <th scope="col">Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($result)): ?>

                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <img src="../public/uploads/<?= $row['image'] ?>" alt="Produk" width="100">
                    </td>

                    <td><?= $row['category_name'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>

        </tbody>
    </table>

</div>

<?php include '../includes/footer.php' ?>