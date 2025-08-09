<?php
require_once "view/header.php";
?>

<aside>
    <center>
        <h3>Transaksi Batal</h3>
        <div id="kanan" class="container mt-4">
            <form method="post" action="proseskonfirmasi">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
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

                                if ($status == 'Dibatalkan') {
                            ?>
                                    <tr align="center">
                                        <td><?php echo $idpesan; ?></td>
                                        <td><?php echo $tglpesann; ?></td>
                                        <td><?php echo $tipe; ?></td>
                                        <td>Rp <?php echo $hargaa; ?></td>
                                        <td><?php echo $persediaan; ?></td>
                                        <td><?php echo $namax; ?></td>
                                        <td><?php echo $telepon; ?></td>
                                        <td><?php echo $tglmasukk; ?></td>
                                        <td><?php echo $tglkeluarr; ?></td>
                                        <td><?php echo $lamahari; ?> hari</td>
                                        <td>Rp <?php echo $angka; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </center>
</aside>

<?php
require_once "view/footer.php";
?>
