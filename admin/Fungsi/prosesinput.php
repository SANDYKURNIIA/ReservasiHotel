<?php
include "koneksi.php";

// Ambil data dari form
$tipe = $_POST['tipe'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$gambar = $_FILES['gambar']['name'];

// Tentukan path gambar
$gambar_path = "../../Savegambar/" . basename($gambar);

// Pindahkan gambar ke folder yang ditentukan
if (move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar_path)) {
    try {
        // Menyimpan data kamar ke database
        $sql = $pdo->prepare("INSERT INTO kamar (tipe, ketersediaan, harga, gambar) VALUES (:tipe, :ketersediaan, :harga, :gambar)");
        $sql->bindParam(':tipe', $tipe, PDO::PARAM_STR);
        $sql->bindParam(':ketersediaan', $jumlah, PDO::PARAM_INT);
        $sql->bindParam(':harga', $harga, PDO::PARAM_INT);
        $sql->bindParam(':gambar', $gambar, PDO::PARAM_STR);
        $sql->execute();

        // Berhasil simpan
        echo "<script>
            alert('Data Kamar Tersimpan');
            window.location.href = '../beranda.php';
        </script>";
    } catch (PDOException $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
} else {
    echo "Gambar gagal diupload.";
}
?>
