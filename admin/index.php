<?php
include "fungsi/koneksi.php";
session_start();

if (isset($_SESSION['ceklog'])) {
    header("Location: beranda.php");
    exit;
} else {
    unset($_SESSION['ceklog']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ffffff, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        .login-container img {
            width: 150px;
            margin-bottom: 20px;
        }
        .btn-login {
            background:#198754;
            color: white;
            border: none;
        }
        .btn-login:hover {
            background-color:#166c21;
        }
    </style>
</head>
<body>
    <div class="login-container text-center">
    <img src="../Gambar/logo.png" class="card-img-top" alt="...">
        <h3 class="mb-3">Login Admin</h3>
        <form method="post" action="fungsi/proseslogin.php">
            <div class="mb-3 text-start">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
            </div>
            <button type="submit" class="btn btn-login w-100" >Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
