<?php
session_start();
require_once "../fungsi/koneksi.php";

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.replace('../')</script>";
    exit();
}

$ambil = $_SESSION['user'];
$sql = $pdo->query("SELECT * FROM tamu WHERE idtamu='$ambil'");
$data = $sql->fetch();
$id = $data['idtamu'];
$username = $data['username'];
$email = $data['email'];
$alamat = $data['alamat'];
$telepon = $data['telepon'];
$password = $data['password'];
$nama = $data['nama'];

$bts = 22;
$nmak = strlen($nama);
if ($nmak > $bts) {
    $nm = substr($nama, 0, $bts) . '...';
} else {
    $nm = $nama;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styling.css">
    <title>Lihat Profil</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="profil.php">
                <center>
                    <!-- Menampilkan gambar profil yang diambil dari database -->
                    <img src="../Gambar/logo.png" 
                         alt="Foto Profil" 
                         style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
                </center>
            </a>
            <!-- Navbar content here -->
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Profil Pengguna</h3>
        <div class="card">
            <div class="card-body">
                <center><h5 class="card-title">Hallo <?= htmlspecialchars($nama) ?></h5></center>
                <p class="card-text"><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                <p class="card-text"><strong>Alamat:</strong> <?= htmlspecialchars($alamat) ?></p>
                <p class="card-text"><strong>Telepon:</strong> <?= htmlspecialchars($telepon) ?></p>

                <a href="edit-profil.php" class="btn btn-warning">Edit Profil</a>
                <a href="index.php" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
