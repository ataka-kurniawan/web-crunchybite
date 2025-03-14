<?php 
include 'includes/header.php';
require 'admin/config.php'; 

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='auth/login.php';</script>";
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id']) || !isset($_GET['quantity']) || !is_numeric($_GET['quantity']) || $_GET['quantity'] < 1) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Permintaan tidak valid!</div></div>";
    include 'includes/footer.php';
    exit;
}

$user_id = $_SESSION['user_id'];
$id = intval($_GET['id']);
$quantity = intval($_GET['quantity']);

// Ambil data produk berdasarkan ID
$query = mysqli_prepare($conn, "SELECT * FROM product WHERE id = ?");
mysqli_stmt_bind_param($query, "i", $id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Produk tidak ditemukan!</div></div>";
    include 'includes/footer.php';
    exit;
}

$totalPrice = $product['price'] * $quantity;
?>

<div class="checkout-container bg-dark">
    <div class="checkout-content">
        <div class="checkout-image">
            <img src="admin/public/uploads/<?= htmlspecialchars($product['image']) ?>"
                class="product-image" alt="<?= htmlspecialchars($product['name']); ?>">
        </div>

        <div class="checkout-details">
            <h2>Checkout</h2>
            <hr>
            <h4> Detail Produk</h4>
            <p><strong>Nama:</strong> <?= htmlspecialchars($product['name']); ?></p>
            <p><strong>Harga Satuan:</strong> Rp<?= number_format($product['price'], 0, ',', '.'); ?></p>
            <p><strong>Jumlah:</strong> <?= $quantity; ?></p>
            <h4 class="total-price">Total: Rp<?= number_format($totalPrice, 0, ',', '.'); ?></h4>

            <hr>
            <h4> Formulir Pengiriman</h4>
            <form action="process_checkout.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                <input type="hidden" name="product_id" value="<?= $id; ?>">
                <input type="hidden" name="quantity" value="<?= $quantity; ?>">
                <input type="hidden" name="total_price" value="<?= $totalPrice; ?>">

                <div class="form-group">
                    <label> Alamat Pengiriman</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label> Jasa Pengiriman</label>
                    <select name="shipping" class="form-control" required>
                        <option value="JNE">JNE</option>
                        <option value="TIKI">TIKI</option>
                        <option value="POS">POS Indonesia</option>
                        <option value="GoSend">GoSend</option>
                        <option value="GrabExpress">GrabExpress</option>
                    </select>
                </div>

                <div class="form-group">
                    <label> Metode Pembayaran</label>
                    <select name="payment" class="form-control" required>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="E-Wallet">E-Wallet</option>
                        <option value="COD">COD</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                    </select>
                </div>

                <button type="submit" class="checkout-button"> Bayar Sekarang</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
.checkout-container {
    background-color:rgb(164, 164, 164);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

.checkout-content {
    display: flex;
    flex-wrap: wrap;
    max-width: 1000px;
    border-radius: 12px;
    overflow: hidden;
    backdrop-filter: blur(10px);
    padding: 20px;
    background: rgba(0, 0, 0, 0.5);
}

/* Bagian gambar */
.checkout-image {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.product-image {
    width: 100%;
    height: 600px; /* Default untuk desktop */
    object-fit: cover;
    border-radius: 12px;
    background-color:rgb(164, 164, 164);
}

/* Detail checkout */
.checkout-details {
    flex: 1;
    padding: 30px;
    color: #fff;
}

.checkout-details h2 {
    color: #FFB74D;
    font-size: 28px;
}

.total-price {
    color: #FF9800;
    font-weight: bold;
    font-size: 22px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    border: none;
    font-size: 16px;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
}

.form-control:focus {
    outline: none;
    border: 2px solid #FFB74D;
}

.checkout-button {
    width: 100%;
    background: #FF6F00;
    border: none;
    font-size: 18px;
    padding: 14px;
    border-radius: 8px;
    cursor: pointer;
    color: #fff;
    font-weight: bold;
    transition: 0.3s;
    text-transform: uppercase;
}

.checkout-button:hover {
    background: #F57C00;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .checkout-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 15px;
    }

    .checkout-image {
        padding: 10px;
    }

    .product-image {
        max-width: 300px; /* Gambar lebih kecil */
        height: auto;
    }

    .checkout-details {
        padding: 20px;
        width: 100%;
    }

    .checkout-details h2 {
        font-size: 24px;
    }

    .total-price {
        font-size: 20px;
    }

    .form-control {
        font-size: 14px;
        padding: 10px;
    }

    .checkout-button {
        font-size: 16px;
        padding: 12px;
    }
}


</style>