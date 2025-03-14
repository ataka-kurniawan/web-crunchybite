<?php
include '../admin/config.php';
session_start();

$message = ''; // Variabel untuk pesan error/success

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true); // Mencegah session fixation attack
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect berdasarkan role
            if ($user['role'] == 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            $message = "⚠️ Password salah!";
        }
    } else {
        $message = "⚠️ Email tidak ditemukan!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: rgb(39, 38, 37);
            height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 350px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            background-color: #D4A055;

        }

        .btn:hover {
            background-color: #D4A055 !important;
            /* Tetap warna oranye */
            color: white !important;
            /* Warna teks tetap putih */
            box-shadow: none !important;
            /* Menghapus efek bayangan */
            opacity: 1 !important;
            /* Pastikan transparansi tetap sama */
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

    <div class="login-card">
        <a href="../index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                <path fill="#D4A055" d="M4 21V9l8-6l8 6v12h-6v-7h-4v7z" />
            </svg>
        </a>
        <h3 class="text-center mb-4">Login</h3>

        <?php if (!empty($message)): ?>
            <div class="alert alert-danger text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
            </div>
            <div class="mb-3 position-relative">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required>

            </div>
            <button type="submit" class="btn text-white w-100">Login</button>
        </form>

        <p class="text-center mt-3">Belum punya akun? <a href="register.php">Register</a></p>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
        }
    </script>

</body>

</html>