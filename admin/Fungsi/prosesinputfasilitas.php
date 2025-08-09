<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript" src="../../lib/sweet.js"></script>
</head>
<body></body>
<?php
require_once('koneksi.php'); // Pastikan koneksi menggunakan PDO sudah benar

// Menangani form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    // Proses gambar
    if ($gambar) {
        // Ambil ekstensi file
        $file_extension = pathinfo($gambar, PATHINFO_EXTENSION);
        $gambar_baru = uniqid() . '.' . $file_extension; // Nama file baru (menggunakan uniqid untuk menghindari duplikasi)
        // Pindahkan file gambar ke folder 'Gambar/' dengan nama baru
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../../Gambar/' . $gambar_baru);
    } else {
        $gambar_baru = null; // Jika tidak ada gambar yang diupload
    }

    try {
        // Menambahkan fasilitas baru
        $sql = $pdo->prepare("INSERT INTO fasilitas (nama_fasilitas, deskripsi, gambar) VALUES (:nama_fasilitas, :deskripsi, :gambar)");
        $sql->bindParam(':nama_fasilitas', $nama_fasilitas, PDO::PARAM_STR);
        $sql->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
        $sql->bindParam(':gambar', $gambar_baru, PDO::PARAM_STR);
        $sql->execute();
        echo "Fasilitas berhasil ditambahkan!";
        header('Location: ../fasilitas.php'); // Redirect setelah menambah
        exit();
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?> 
</html>
