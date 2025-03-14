<?php
include 'admin/config.php';

// Ambil produk dari database
$query = "SELECT image FROM product LIMIT 6"; // Batasi jumlah produk yang ditampilkan
$result = mysqli_query($conn, $query);

// Simpan hasil query ke dalam array
$images = [];
while ($row = mysqli_fetch_assoc($result)) {
    $images[] = $row['image'];
}
?>

<?php include 'includes/header.php' ?>
<!-- Hero Section -->
<section class="hero d-flex align-items-center justify-content-center text-center text-white" data-aos="fade-in"
    data-aos-duration="1000">
    <div class="hero-content">
        <h3 data-aos="fade-in" data-aos-delay="300">Selamat Datang di</h3>
        <h1 data-aos="zoom-in" data-aos-delay="500">CrunchyBite</h1>
        <p data-aos="fade-in" data-aos-delay="700">Kami Menghidangkan Kelezatan Pastri & Kue dengan Sentuhan Istimewa
        </p>
        <a href="/web-crunchybite/product.php" class="btn-cta px-4 py-2 rounded-pill text-light mt-3"
            onclick="alert('halo saya putri suria lestari dengan nim 2311103077')" data-aos="zoom-in"
            data-aos-delay="900">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="#fff"
                    d="M7 22q-.825 0-1.412-.587T5 20t.588-1.412T7 18t1.413.588T9 20t-.587 1.413T7 22m10 0q-.825 0-1.412-.587T15 20t.588-1.412T17 18t1.413.588T19 20t-.587 1.413T17 22M5.2 4h16.5l-4.975 9H8.1L7 15h12v2H3.625L6.6 11.6L3 4H1V2h3.25z" />
            </svg> BELI SEKARANG
        </a>
    </div>
</section>


<!-- about us section  -->
<section id="about" class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Bagian Gambar -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="image-container">
                    <img src="assets/image/roti.jpg" class="img-fluid img-1" alt="Croissant">
                    <img src="assets/image/roti2.jpg" class="img-fluid img-2" alt="Sliced Bread">
                </div>
            </div>

            <!-- Bagian Konten -->
            <div class="col-lg-6" data-aos="fade-left">
                <p class="section-subtitle">ABOUT US</p>
                <h2 class="section-title">We Bake Every Item From The Core Of Our Hearts</h2>
                <p>
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.
                    Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet.
                </p>
                <p>
                    Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.
                </p>
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up">
                        <p>✔ Quality Products</p>
                        <p>✔ Online Order</p>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <p>✔ Custom Products</p>
                        <p>✔ Home Delivery</p>
                    </div>
                </div>
                <a href="/web-crunchybite/about.php" class="btn btn-primary" data-aos="zoom-in">Read More</a>
            </div>
        </div>
    </div>
</section>

<!-- section services -->
<section class="services-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom Kiri -->
            <div class="col-md-6" data-aos="fade-right">
                <h1 class="mb-3">What Do We Offer For You?</h1>
                <p>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos.</p>

                <div class="row">
                    <!-- Layanan 1 -->
                    <div class="col-md-6" data-aos="flip-left">
                        <div class="service-item">
                            <div class="service-icon">📦</div>
                            <div class="service-text">
                                <h5>Quality Products</h5>
                                <p>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan 2 -->
                    <div class="col-md-6" data-aos="flip-right">
                        <div class="service-item">
                            <div class="service-icon">🎨</div>
                            <div class="service-text">
                                <h5>Custom Products</h5>
                                <p>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Layanan 3 -->
                    <div class="col-md-6" data-aos="flip-left" data-aos-delay="200">
                        <div class="service-item">
                            <div class="service-icon">🛒</div>
                            <div class="service-text">
                                <h5>Online Order</h5>
                                <p>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan 4 -->
                    <div class="col-md-6" data-aos="flip-right" data-aos-delay="200">
                        <div class="service-item">
                            <div class="service-icon">🚚</div>
                            <div class="service-text">
                                <h5>Home Delivery</h5>
                                <p>Magna sea eos sit dolor, ipsum amet ipsum lorem diam eos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6 text-center d-none d-md-block" data-aos="fade-left">
                <div class="service-img">
                    <img src="assets/image/roti3.jpg" alt="Service Image">
                </div>
            </div>
        </div>
</section>

<!-- section product -->
<section class="product-section">
    <div class="container">
        <h1>Our Products</h1>
        <p>Discover our high-quality and best-selling products</p>

        <?php if (!empty($images)): ?>
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <?php
                    $chunkedImages = array_chunk($images, 3); // Membagi gambar menjadi kelompok 3
                    foreach ($chunkedImages as $index => $chunk):
                    ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="d-flex justify-content-center">
                                <?php foreach ($chunk as $image): ?>
                                    <div class="product-card mx-2">
                                        <img src="admin/public/uploads/<?php echo $image; ?>" class="img-fluid" alt="Product Image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <!-- Tombol Navigasi -->
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        <?php endif; ?>

        <a href="/web-crunchybite/product.php">
            <button type="button" class="btn btn-primary  px-4">Lihat Produk</button>
        </a>
</section>






<?php include 'includes/footer.php' ?>