<?php
    session_start();
    require_once "fungsi/koneksi.php";
    if (isset($_SESSION['user'])) {
        echo "<script>window.location.replace('user/')</script>";
    } else {
        unset($_SESSION['user']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styling.css">
    <script type="text/javascript" src="lib/sweet.js"></script>
    <title>Dashboard Utama</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" >
    <div class="container-fluid">
         <a class="navbar-brand" href="#"><center><img src="Gambar/logo.png" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;"></center></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-3 mb-lg-0 mx-auto p-2 grid gap-4 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kamar.php">Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="fasilitas.php">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="daftar.php">Daftar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
