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

                        <!-- Tombol Login (Mobile) -->
                        <li class="nav-item d-lg-none mt-2">
                            <a href="/web-crunchybite/admin/login.php" class="btn btn-warning w-100">Login</a>
                        </li>
                    </ul>

                    <!-- Tombol Login (Desktop) -->
                    <a href="/web-crunchybite/admin/login.php" class="btn-login py-2 px-4 d-none d-lg-block">Login</a>
                </div>
            </div>
        </nav>
    </header>
