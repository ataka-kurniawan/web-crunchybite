<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Styling Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #343a40;
            padding-top: 20px;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: white;

            padding: 12px 20px;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            transition: 0.3s;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Sidebar Collapse */
        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }

        /* Navbar */
        .navbar {
            padding: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-item .nav-link {
            padding: 10px 15px;
        }
    </style>
</head>

<body>

    <div class="d-flex">

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar text-white">
            <div class="text-center mb-4">
                <h4>Admin Panel</h4>
            </div>
            <ul class="nav flex-column">
                <li><a href="/web-crunchybite/admin/" class="nav-link"><i class="fa fa-home"></i>
                        <span>Dashboard</span></a></li>
                <li><a href="/web-crunchybite/admin/product/index.php" class="nav-link"><i class="fa fa-box"></i>
                        <span>Kelola Produk</span></a></li>
                <li><a href="/web-crunchybite/admin/category/index.php" class="nav-link"><i class="fa fa-folder"></i>
                        <span>Kelola Kategori</span></a></li>
                <li><a href="/web-crunchybite/admin/customer/index.php" class="nav-link"><i class="fa fa-users"></i>
                        <span>Customers</span></a></li>
                <li>
                <li><a href="/web-crunchybite/admin/transaction/index.php" class="nav-link"><i class="fa fa-exchange"></i>
                        <span>Kelola Transaksi</span></a></li>
                <li>
                    <form action="\web-crunchybite\auth\logout.php" method="POST">
                        <button type="submit" class="nav-link  d-flex align-items-center">
                            <i class="fa fa-sign-out-alt me-2"></i> <span>Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-100" style="margin-left: 250px;">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button id="toggleSidebar" class="btn btn-dark me-3"><i class="fa fa-bars"></i></button>
                    <a class="navbar-brand">Dashboard Admin</a>



                    <div class="dropdown ms-3">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <img src="https://github.com/mdo.png" alt="Profile" width="32" height="32"
                                class="rounded-circle me-2">
                            <strong>Admin</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <form action="\web-crunchybite\auth\logout.php" method="POST">
                                <button type="submit" class="dropdown-item">Sign out</button>
                            </form>

                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid mt-4">