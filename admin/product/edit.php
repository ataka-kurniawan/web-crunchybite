<?php include '../../auth/check_admin.php'; ?>

<?php
include '../config.php';

// Cek apakah ada ID yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan!'); window.history.back();</script>";
    exit();
}

$id = $_GET['id'];

// Ambil data produk dari database berdasarkan ID
$query = "SELECT * FROM product WHERE id = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<script>alert('Produk tidak ditemukan!'); window.history.back();</script>";
    exit();
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['product_name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $stock = htmlspecialchars($_POST['stock']);
    $category = htmlspecialchars($_POST['category_id']);


    // Validasi dan upload gambar baru jika ada
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if (!in_array($image_ext, $allowed_extensions)) {
            echo "<script>alert('Format gambar harus JPG, JPEG, atau PNG!'); window.history.back();</script>";
            exit();
        }

        // Hapus gambar lama jika ada
        if (!empty($product['image']) && file_exists("../public/uploads/" . $product['image'])) {
            unlink("../public/uploads/" . $product['image']);
        }

        // Simpan gambar baru
        $upload_dir = "../public/uploads/";
        $image_new_name = uniqid() . '.' . $image_ext;
        move_uploaded_file($image_tmp, $upload_dir . $image_new_name);
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $image_new_name = $product['image'];
    }

    // Update data produk di database
    $update_query = "UPDATE product SET 
                        name='$name', 
                        description='$description', 
                        price='$price', 
                        stock='$stock', 
                        category_id='$category', 
                        image='$image_new_name' 
                    WHERE id=$id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk!'); window.history.back();</script>";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="product_name" value="<?= $product['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= $product['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= $product['stock'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="7" <?= ($product['category_id'] == 7) ? 'selected' : '' ?>>Kue Kering</option>
                <option value="2" <?= ($product['category_id'] == 2) ? 'selected' : '' ?>>Kue Basah</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Gambar Baru (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
            <?php if (!empty($product['image'])) : ?>
                <p class="mt-2">Gambar saat ini:</p>
                <img src="../public/uploads/<?= $product['image'] ?>" alt="Gambar Produk" width="150">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
