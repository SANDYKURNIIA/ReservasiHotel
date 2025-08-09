<?php
require_once '../Fungsi/midtrans-config.php';
require_once '../fungsi/koneksi.php'; // Pastikan koneksi database diimpor

if (!isset($_POST['idpesan']) || !isset($_POST['totalbayar'])) {
    die("Data tidak valid!");
}

$idpesan = $_POST['idpesan'];
$totalbayar = floatval($_POST['totalbayar']); // Pastikan totalbayar adalah tipe float


try {
    // Ambil data pengguna dari database berdasarkan `idpesan`
    $sqlPesanan = $pdo->prepare("
        SELECT tamu.nama, tamu.email, tamu.telepon 
        FROM pemesanan 
        INNER JOIN tamu ON pemesanan.idtamu = tamu.idtamu 
        WHERE pemesanan.idpesan = :idpesan
    ");
    $sqlPesanan->execute(['idpesan' => $idpesan]);
    $dataTamu = $sqlPesanan->fetch(PDO::FETCH_ASSOC);

    if (!$dataTamu) {
        throw new Exception("Data tamu tidak ditemukan!");
    }

    // Detail transaksi
    $transactionDetails = [
        'order_id' => 'ORDER-' . $idpesan,
        'gross_amount' => (int) $totalbayar,
    ];

    // Detail pelanggan dari database
    $customerDetails = [
        'first_name' => $dataTamu['nama'],
        'email' => $dataTamu['email'],
        'phone' => $dataTamu['telepon'],
    ];

    // Parameter untuk Midtrans Snap
    $params = [
        'transaction_details' => $transactionDetails,
        'customer_details' => $customerDetails,
    ];

    // Generate token Snap
    $snapToken = \Midtrans\Snap::getSnapToken($params);


    // Redirect ke halaman pembayaran Midtrans
    echo "<html><body>";
    echo "<script src='https://app.sandbox.midtrans.com/snap/snap.js' data-client-key='CLIENT_KEY_ANDA'></script>";
    echo "<script type='text/javascript'>
            snap.pay('$snapToken', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    window.location.href = 'datapesanan.php?idpesan=$idpesan';
                },
                onPending: function(result) {
                    alert('Pembayaran sedang diproses.');
                    window.location.href = 'datapesanan.php?idpesan=$idpesan';
                },
                onError: function(result) {
                    alert('Pembayaran gagal.');
                    window.location.href = 'datapesanan.php?idpesan=$idpesan';
                }
            });
          </script>";
    echo "</body></html>";
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
