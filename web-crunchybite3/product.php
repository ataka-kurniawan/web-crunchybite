<?php include 'includes/header.php'; ?>

<section class="hero-d">
    <div class="hero-d-content" data-aos="fade-up" data-aos-duration="1000">
        <h3>Selamat Datang di</h3>
        <h1>CrunchyBite Store</h1>
        <p>Temukan berbagai produk terbaik hanya di sini.</p>
        <a href="#product" class="btn-cta px-4 py-2 rounded-pill text-light mt-3">Shop Now</a>
    </div>
</section>

<!-- Product Section -->
<section class="product-d-section py-5" id="product">
    <div class="container">
        <h2 class="text-center mb-4" data-aos="fade-down" data-aos-duration="1000">Our Products</h2>

        <!-- Form Pencarian -->
        <form method="GET" action="" class="mb-4 text-center">
            <input type="text" name="search" autocomplete="none" placeholder="Cari produk..."
                value="<?= htmlspecialchars($search) ?>" class="form-control d-inline-block w-50">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Menampilkan kategori sebagai filter -->
        <div class="text-center mb-4 d-flex justify-content-center flex-wrap gap-3">
            <a href="product.php" class="badge bg-warning badge-pill text-decoration-none">All</a>
            <?php while ($category = mysqli_fetch_assoc($categoryResult)): ?>
                <a href="?category=<?= urlencode($category['name']) ?>"
                    class="badge bg-secondary badge-pill text-decoration-none <?= ($selectedCategory == $category['name']) ? 'bg-primary' : '' ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </a>
            <?php endwhile; ?>
        </div>

        <div class="row">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card product-d-card h-100">
                            <div class="card-body d-flex flex-column text-center">
                                <img src="admin/public/uploads/<?= htmlspecialchars($row['image']) ?>" alt="Produk"
                                    class="img-fluid mx-auto d-block"
                                    style="max-width: 200px; height: 150px; object-fit: cover;">
                                <h5 class="card-title mt-3"><?= htmlspecialchars($row['product_name']) ?></h5>
                             
                                <p class="price">RP. <?= number_format($row['price'], 0, ',', '.') ?></p>
                                <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-primary mt-auto">Buy Now</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada produk yang ditemukan.</p>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>