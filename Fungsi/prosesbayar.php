<?php
require_once "../fungsi/koneksi.php";

if (!isset($_GET['idpesan'])) {
    die("ID Pesanan tidak valid!");
}

$idpesan = $_GET['idpesan'];

try {
    // Update status pembayaran menjadi "Lunas"
    $sql = $pdo->prepare("UPDATE pemesanan SET status = 'Lunas' WHERE idpesan = :idpesan");
    $sql->execute(['idpesan' => $idpesan]);

    echo "Pembayaran berhasil diperbarui untuk ID Pesanan: $idpesan";
	
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
