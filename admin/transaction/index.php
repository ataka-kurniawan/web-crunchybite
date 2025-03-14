<?php
include '../config.php';

// Ambil data orders dari database
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

// Jika tombol update ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $order_status = trim(strtolower($_POST['order_status'])); // Ubah ke huruf kecil

    // Validasi agar sesuai ENUM
    $valid_status = ['pending', 'processed', 'shipped'];
    if (!in_array($order_status, $valid_status)) {
        die("Error: Status tidak valid!");
    }

    // Update status order
    $query_update = "UPDATE orders SET order_status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query_update);
    mysqli_stmt_bind_param($stmt, "si", $order_status, $order_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Status berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

include '../includes/header.php';
?>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Transaksi</h2>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Id</th>
                <th scope="col">Product Id</th>
                <th scope="col">Alamat</th>
                <th scope="col">Metode Pembayaran</th>
                <th scope="col">Jasa Pengiriman</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Order Status</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['payment_method'] ?></td>
                    <td><?= $row['shipping_service'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['total_price'] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                            <select name="order_status" class="form-select">
                                <option value="pending" <?= $row['order_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="processed" <?= $row['order_status'] == 'processed' ? 'selected' : '' ?>>Processed</option>
                                <option value="shipped" <?= $row['order_status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-primary btn-sm mt-2">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
