<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript" src="../../lib/sweet.js"></script>
</head>
<body></body>
<?php
require_once('koneksi.php');

// Ambil id fasilitas dari URL
$id = $_GET['id'];

// Ambil nama gambar sebelum dihapus
$sql = $pdo->prepare("SELECT gambar FROM fasilitas WHERE id = :id");
$sql->bindParam(':id', $id, PDO::PARAM_INT);
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);

// Hapus gambar jika ada
if ($row['gambar']) {
    $gambarPath = '../Gambar/' . $row['gambar'];
    if (file_exists($gambarPath)) {
        unlink($gambarPath); // Hapus gambar dari folder
    }
}

// Hapus fasilitas dari database
try {
    $sql = $pdo->prepare("DELETE FROM fasilitas WHERE id = :id");
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();

    // Tampilkan SweetAlert setelah berhasil menghapus
    echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Fasilitas berhasil dihapus.',
                type: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../fasilitas.php'; // Redirect ke halaman setelah OK
            });
          </script>";
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
