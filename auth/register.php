<?php
include '../admin/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'customer'; // Default role adalah customer

    $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn {
            background-color: #D4A055;
            color: white;
        }

        /* Hapus efek hover */
        .btn:hover {
            background-color: #D4A055;
            color: white;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100  bg-dark">
    <div class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center">Register</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Nama" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-hover w-100">Register</button>
        </form>
        <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>

</html>