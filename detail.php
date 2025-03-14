<?php include 'includes/header.php'; ?>
<?php
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Produk tidak ditemukan!</div></div>";
    include 'includes/footer.php';
    exit;
}
$id = intval($_GET['id']);
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
?>

<div class="wrapper d-flex flex-column min-vh-100">
    <div class="container flex-grow-1 d-flex align-items-center py-5">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="admin/public/uploads/<?= htmlspecialchars($product['image']) ?>"
                            class="img-fluid rounded product-image" alt="<?= htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="col-md-6 d-flex flex-column justify-content-center text-light">
                        <h2 class="product-title"> <?= htmlspecialchars($product['name']); ?> </h2>
                        <h4 class="price-tag">Rp<span id="harga"> <?= number_format($product['price'], 0, ',', '.'); ?>
                            </span></h4>
                        <p class="product-description"> <?= nl2br(htmlspecialchars($product['description'])); ?> </p>
                        <div class="quantity-wrapper mt-3 d-flex align-items-center justify-content-start">
                            <button class="btn btn-secondary quantity-btn" onclick="ubahQuantity(-1)">-</button>
                            <input type="number" id="quantity" class="quantity-input mx-2" value="1" min="1" readonly>
                            <button class="btn btn-secondary quantity-btn" onclick="ubahQuantity(1)">+</button>
                        </div>
                        <h4 class="total-price mt-3">Total: Rp<span id="totalHarga">
                                <?= number_format($product['price'], 0, ',', '.'); ?> </span></h4>
                        <div class="mt-4 d-flex gap-2">
                            <a href="checkout.php?id=<?= $product['id']; ?>&quantity=" id="checkoutBtn" class="btn text-white btn-custom flex-grow-1">Checkout</a>
                            <a href="index.php" class="btn btn-secondary flex-grow-1">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
   .wrapper {
    background-color:rgb(164, 164, 164);
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
}

/* Overlay untuk membuat background lebih gelap */
.wrapper::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Sesuaikan opacity jika perlu */
    z-index: 1;
}

/* Konten di atas overlay */
.container {
    position: relative;
    z-index: 2;
}

/* Styling lainnya tetap */
.product-image {
    max-width: 100%;
    width: 500px;
    height: auto;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.product-title {
    font-size: 28px;
    font-weight: bold;
    color: white;
}

.price-tag {
    font-size: 24px;
    font-weight: bold;
    color: #D4A055;
}

.product-description {
    font-size: 16px;
    color: #ecf0f1;
}

.quantity-wrapper .quantity-btn {
    width: 40px;
    height: 40px;
    font-size: 20px;
    background-color: #666;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.quantity-btn:hover {
    background-color: #444;
}

.quantity-input {
    width: 50px;
    height: 40px;
    text-align: center;
    font-size: 18px;
    border: 2px solid #ccc;
    border-radius: 8px;
    background-color: white;
}

.total-price {
    font-size: 20px;
    font-weight: bold;
    color: #D4A055;
}

.btn-custom {
    background-color: #D4A055;
    color: black;
    font-size: 16px;
    border-radius: 8px;
}

.btn-custom:hover {
    background-color:#D4A055;
}

</style>

<script>
    let hargaProduk = <?= $product['price']; ?>;
    let quantityInput = document.getElementById("quantity");
    let totalHargaSpan = document.getElementById("totalHarga");
    let checkoutBtn = document.getElementById("checkoutBtn");

    function ubahQuantity(value) {
        let currentQuantity = parseInt(quantityInput.value);
        let newQuantity = Math.max(currentQuantity + value, 1);
        quantityInput.value = newQuantity;
        updateTotalHarga(newQuantity);
    }

    function updateTotalHarga(quantity) {
        let totalHarga = hargaProduk * quantity;
        totalHargaSpan.innerText = totalHarga.toLocaleString("id-ID");
    }

    checkoutBtn.addEventListener("click", function (e) {
        e.preventDefault();
        let quantity = quantityInput.value;
        window.location.href = `checkout.php?id=<?= $product['id']; ?>&quantity=${quantity}`;
    });
</script>