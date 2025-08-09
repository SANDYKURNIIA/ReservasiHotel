<?php
require_once "view/header.php";
?>

<aside>
    <div class="container text-center my-4">
        <h3 class="mb-4">Transaksi Berhasil</h3>
        <div id="kanan">
            <form method="post" action="proseskonfirmasi">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = $pdo->query("SELECT * FROM view_pemesanan_kamar ORDER BY idpesan DESC");
                        while ($datax = $sql->fetch()) {
                            $idpesan = $datax['idpesan'];
                            $tglpesan = $datax['tglpesan'];
                            $batasbayar = $datax['batasbayar'];
                            $tipe = $datax['tipe'];
                            $harga = $datax['harga'];
                            $persediaan = $datax['ketersediaan'];
                            $namax = $datax['nama'];
                            $alamat = $datax['alamat'];
                            $telepon = $datax['telepon'];
                            $tglmasuk = $datax['tglmasuk'];
                            $tglkeluar = $datax['tglkeluar'];
                            $lamahari = $datax['lamahari'];
                            $status = $datax['status'];

                            $tglpesann = date('d/m/Y', strtotime($tglpesan));
                            $tglmasukk = date('d/m/Y', strtotime($tglmasuk));
                            $tglkeluarr = date('d/m/Y', strtotime($tglkeluar));
                            $batasbayarr = date('d/m/Y H:i:s', strtotime($batasbayar));
                            $batasjam = date('H:i:s', strtotime($batasbayar));

                            $hargaa = number_format($harga, 0, ",", ".");

                            // Hitung total bayar berdasarkan harga dan lama menginap
                            $totalbayar = $harga * $lamahari;
                            $angka = number_format($totalbayar, 0, ",", ".");

                            if ($status == 'Berhasil') {
                    ?>
                    <tr class="text-center">
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
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>

        <!-- Button untuk cetak laporan -->
        <a href="laporan-transaksi" target="_blank">
            <button id="laporan" class="btn btn-laporan btn-lg mt-4">Cetak Laporan</button>
        </a>
    </div>
</aside>

<?php
require_once "view/footer.php";
?>
