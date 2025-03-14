<?php
session_start();
include __DIR__ . '/../admin/config.php';

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // Ambil nama user dari database menggunakan prepared statement
    $query = "SELECT name FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $username = $user['name'] ?? 'Guest'; // Menangani jika nama tidak ditemukan
} else {
    $username = 'Guest';
}
?>
<?php
include 'admin/config.php';

// Ambil kategori dan pencarian dari parameter URL
$selectedCategory = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query untuk mendapatkan daftar kategori unik
$categoryQuery = "SELECT DISTINCT name FROM category";
$categoryResult = mysqli_query($conn, $categoryQuery);

// Query untuk mendapatkan produk berdasarkan kategori dan pencarian
$query = "SELECT product.id,
    product.name AS product_name,
    product.price,
    product.stock,
    product.description,
    category.name AS category_name,
    product.image 
    FROM product 
    LEFT JOIN category ON product.category_id = category.id";

// Filter berdasarkan kategori dan pencarian
$conditions = [];

if (!empty($selectedCategory)) {
    $conditions[] = "category.name = '$selectedCategory'";
}
if (!empty($search)) {
    $conditions[] = "(product.name LIKE '%$search%' OR product.description LIKE '%$search%')";
}

// Gabungkan kondisi jika ada
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $query);
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyBite</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/web-crunchybite/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" data-aos="fade-down" data-aos-duration="800">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="/web-crunchybite/index.php">CrunchyBite</a>

                <!-- Tombol Hamburger (Mobile) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Navigasi -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto text-center gap-4">
                        <li class="nav-item">
                            <a class="nav-link" href="/web-crunchybite/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/web-crunchybite/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/web-crunchybite/contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/web-crunchybite/product.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24">
                                    <path fill="#fff"
                                        d="M7 22q-.825 0-1.412-.587T5 20t.588-1.412T7 18t1.413.588T9 20t-.587 1.413T7 22m10 0q-.825 0-1.412-.587T15 20t.588-1.412T17 18t1.413.588T19 20t-.587 1.413T17 22M5.2 4h16.5l-4.975 9H8.1L7 15h12v2H3.625L6.6 11.6L3 4H1V2h3.25z" />
                                </svg> Our Product
                            </a>
                        </li>
                    </ul>

                    <!-- Jika user sudah login sebagai customer, tampilkan ikon profil dengan dropdown -->
                    <?php if ($user_id): ?>
                        <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button"
                                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user-circle fa-lg"></i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#495d6a" fill-rule="evenodd"
                                            d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span><?php echo htmlspecialchars($username); ?></span>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    </li>
                                    <li>
                                        <form action="/web-crunchybite/auth/logout.php" method="POST">
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Tombol Login -->
                        <div class="d-flex justify-content-center justify-content-lg-end mt-3 mt-lg-0">
                            <a href="/web-crunchybite/auth/login.php" style="background-color: #D4A055; color: white; text-decoration: none; padding: 10px 20px; display: inline-block; "  class=" py-2 px-4">Login</a>
                        </div>
                    <?php endif; ?>


                    <!-- Tombol Login (Mobile) -->
                    <?php if (!$user_id): ?>
                        <a href="/web-crunchybite/auth/login.php" class="btn btn-warning w-100 d-lg-none mt-2">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>