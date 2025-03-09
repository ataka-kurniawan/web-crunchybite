<?php include 'includes/header.php'; ?>

<section class="hero-d">
    <div class="hero-d-content" data-aos="fade-up" data-aos-duration="1000">
        <h3>Selamat Datang di</h3>
        <h1>CrunchyBite Store</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, cupiditate.</p>
        <a href="#product" class="btn-cta px-4 py-2 rounded-pill text-light mt-3" onclick="alert('halo saya ataka putu samsuri kurniawan dengan nim 2211103129')">
            Shop Now</a>
    </div>
</section>

<!-- Product Section -->
<section class="product-d-section py-5" id="product">
    <div class="container">
        <h2 class="text-center mb-4" data-aos="fade-down" data-aos-duration="1000">Our Products</h2>
        
        <div class="text-center mb-4 d-flex justify-content-center flex-wrap gap-3" data-aos="fade-up" data-aos-duration="1000">
            <span class="badge bg-secondary badge-pill">Bakery</span>
            <span class="badge bg-secondary badge-pill">Pastry</span>
            <span class="badge bg-secondary badge-pill">Cakes</span>
            <span class="badge bg-secondary badge-pill">Cookies</span>
        </div>

        <div class="row">
            <!-- Product Card 1 -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-duration="1000">
                <div class="card product-d-card">
                    <img src="assets/image/roti.jpg" class="card-img-top" alt="Product 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">Short description of the product.</p>
                        <p class="price">$99.99</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                <div class="card product-d-card">
                    <img src="assets/image/roti.jpg" class="card-img-top" alt="Product 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">Short description of the product.</p>
                        <p class="price">$99.99</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="400">
                <div class="card product-d-card">
                    <img src="assets/image/roti.jpg" class="card-img-top" alt="Product 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">Short description of the product.</p>
                        <p class="price">$99.99</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="600">
                <div class="card product-d-card">
                    <img src="assets/image/roti.jpg" class="card-img-top" alt="Product 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product Name</h5>
                        <p class="card-text">Short description of the product.</p>
                        <p class="price">$99.99</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
