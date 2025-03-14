<?php include '../../auth/check_admin.php'; ?>

<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input ada sebelum mengaksesnya
    $name = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
    $category_id = isset($_POST['category_name']) ? intval($_POST['category_name']) : 0; // Ambil ID kategori

    // Validasi kategori ada di database
    $checkCategory = mysqli_query($conn, "SELECT id FROM category WHERE id = $category_id");
    if (mysqli_num_rows($checkCategory) == 0) {
        echo "<script>alert('Kategori tidak ditemukan!'); window.history.back();</script>";
        exit();
    }

    // Validasi dan upload gambar
    $image_new_name = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if (!in_array($image_ext, $allowed_extensions)) {
            echo "<script>alert('Format gambar harus JPG, JPEG, atau PNG!'); window.history.back();</script>";
            exit();
        }

        // Pastikan folder uploads ada
        $upload_dir = "../public/uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Simpan dengan nama unik
        $image_new_name = uniqid() . '.' . $image_ext;
        move_uploaded_file($image_tmp, $upload_dir . $image_new_name);
    }

    // Simpan ke database
    $query = "INSERT INTO product (name, description, price, stock, category_id, image) 
              VALUES ('$name', '$description', '$price', '$stock', '$category_id', '$image_new_name')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk!'); window.history.back();</script>";
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Tambah Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="product_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category_name" required>
                <option value="">Pilih Kategori</option>
                <?php
                $categories = mysqli_query($conn, "SELECT id, name FROM category");
                while ($row = mysqli_fetch_assoc($categories)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Gambar</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
