<?php
require_once "view/header.php";
require_once "../vendor/autoload.php"; // Autoload Midtrans SDK

use Midtrans\Config;
use Midtrans\Transaction;

// Konfigurasi Midtrans
Config::$serverKey = 'SB-Mid-server-3i7vL6TAwld3uO3z07frKwmr'; // Ganti dengan server key Anda
Config::$isProduction = false; // Ganti menjadi true untuk production
Config::$isSanitized = true;
Config::$is3ds = true;

// Fungsi untuk mendapatkan status pembayaran Midtrans
function getPaymentStatus($order_id)
{
    try {
        $status = Transaction::status($order_id);
        error_log(json_encode($status)); // Log hasil $status untuk debug
        return isset($status['transaction_status']) ? $status['transaction_status'] : null; // Gunakan array-style access
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log error
        return null;
    }
}

?>

<aside>
    <center>
        <h3>Konfirmasi Pesanan</h3>
        <div id="kanan">
            <!-- Gunakan kelas Bootstrap untuk tabel -->
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Kd</th>
                        <th>Tgl</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Lama</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $pdo->query("SELECT * FROM view_pemesanan_kamar ORDER BY idpesan DESC");
                    while ($datax = $sql->fetch()) {
                        $idpesan = $datax['idpesan'];
                        $tglpesan = $datax['tglpesan'];
                        $tipe = $datax['tipe'];
                        $harga = $datax['harga'];
                        $persediaan = $datax['ketersediaan'];
                        $namax = $datax['nama'];
                        $telepon = $datax['telepon'];
                        $tglmasuk = $datax['tglmasuk'];
                        $tglkeluar = $datax['tglkeluar'];
                        $lamahari = $datax['lamahari'];
                        $status = $datax['status'];

                        $tglpesann = date('d/m/Y', strtotime($tglpesan));
                        $tglmasukk = date('d/m/Y', strtotime($tglmasuk));
                        $tglkeluarr = date('d/m/Y', strtotime($tglkeluar));
                        $hargaa = number_format($harga, 0, ",", ".");

                        // Hitung total bayar berdasarkan harga dan lama menginap
                        $totalbayar = $harga * $lamahari;
                        $angka = number_format($totalbayar, 0, ",", ".");

                        // Dapatkan status pembayaran dari Midtrans
                        $midtrans_status = getPaymentStatus($idpesan); // Ambil status pembayaran dari Midtrans
                        if ($midtrans_status) {
                            $payment_status = $midtrans_status; // Status pembayaran dari Midtrans
                        } else {
                            $payment_status = $status; // Jika gagal, tampilkan status lama (misal: Pending)
                        }

                        if ($payment_status == 'Pending') {
                            ?>
                            <tr align="center" style="font-weight: normal; font-size: 12px;">
                                <td><?php echo $idpesan ?></td>
                                <td><?php echo $tglpesann ?></td>
                                <td><?php echo $tipe ?></td>
                                <td><?php echo $hargaa ?></td>
                                <td><?php echo $persediaan ?></td>
                                <td><?php echo $namax ?></td>
                                <td><?php echo $telepon ?></td>
                                <td><?php echo $tglmasukk ?></td>
                                <td><?php echo $tglkeluarr ?></td>
                                <td><?php echo $lamahari ?> hari</td>
                                <td><?php echo $angka ?></td>
                                <td><?php echo $payment_status ?></td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="fungsi/proseskonfirmasi?id=<?php echo $idpesan ?>">
                                            <button class="btn btn-danger btn-sm">Konfirmasi</button>
                                        </a>
                                        <a href="fungsi/prosesbatal?id=<?php echo $idpesan ?>">
                                            <button class="btn btn-dark btn-sm">Batalkan</button>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </center>
</aside>

<?php
require_once "view/footer.php";
?>
