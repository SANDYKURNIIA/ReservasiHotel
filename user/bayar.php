<?php
require_once "../fungsi/koneksi.php";

// Periksa apakah idpesan dikirim melalui POST
if (!isset($_POST['idpesan']) || empty($_POST['idpesan'])) {
    die("Data pemesanan tidak ditemukan");
}

// Ambil ID Pesan dari POST
$idpesan = $_POST['idpesan'];

try {
    // Ambil data pemesanan berdasarkan idpesan
    $sql = $pdo->prepare("SELECT * FROM pemesanan WHERE idpesan = :idpesan");
    $sql->execute(['idpesan' => $idpesan]);
    $data = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        die("Data pemesanan tidak ditemukan");
    }

    

    // Tampilkan data pemesanan untuk pembayaran
    echo "<h3>Detail Pemesanan</h3>";
    echo "<p><strong>ID Pesan:</strong> {$data['idpesan']}</p>";
    echo "<p><strong>Nama:</strong> {$data['nama']}</p>";
    echo "<p><strong>Alamat:</strong> {$data['alamat']}</p>";
    echo "<p><strong>Total Bayar:</strong> Rp. " . number_format($data['totalbayar'], 0, ',', '.') . "</p>";

    // Tambahkan tombol untuk proses pembayaran
    echo "<form action='../fungsi/proses_bayar.php' method='POST'>";
    echo "<input type='hidden' name='idpesan' value='{$data['idpesan']}'>";
    echo "<button type='submit' class='btn-bayar'>Proses Pembayaran</button>";
    echo "</form>";
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . htmlspecialchars($e->getMessage());
}
?>
