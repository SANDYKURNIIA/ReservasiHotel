<?php
require_once "view/header.php";
require_once "../fungsi/koneksi.php";

// Pastikan parameter ID tamu tersedia dan valid
if (!isset($ambil) || !is_numeric($ambil)) {
    die("<p class='text-danger text-center'>ID Tamu tidak valid!</p>");
}

?>

<div class="card shadow">
    <div class="card-header bg-brown text-white text-center">
        <h3>Data Pemesanan Kamar</h3>
    </div>
    <div class="card-body">
        <?php
        try {
            // Ambil data pemesanan berdasarkan ID tamu
            $sqlx = $pdo->prepare("
                 SELECT 
                        p.idpesan, p.tglpesan, p.batasbayar, p.idkamar, 
                        k.tipe, k.harga, p.ketersediaan, p.nama, p.alamat, 
                        p.telepon, p.tglmasuk, p.tglkeluar, p.lamahari, 
                        p.totalbayar, p.status, k.gambar
                    FROM pemesanan as p
                    INNER JOIN kamar k ON p.idkamar = k.idkamar
                    WHERE p.idtamu = :idtamu 
                    ORDER BY p.idpesan DESC
            ");
            $sqlx->execute(['idtamu' => $ambil]);
            $hasil = $sqlx->fetchAll(PDO::FETCH_ASSOC);

            if (!$hasil) {
                echo "<p class='text-muted text-center'>Belum ada data pemesanan yang tersedia.</p>";
            } else {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                        <tr>
                            <th>Gambar</th>
                            <th>ID Pesan</th>
                            <th>Tipe Kamar</th>
                            <th>Harga/Malam</th>
                            <th>Lama Hari</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                      </thead>";
                echo "<tbody>";

                foreach ($hasil as $datax) {
                     // Format tanggal dan angka
                     $tglpesan = date('d-m-Y H:i:s', strtotime($datax['tglpesan']));
                     $batasbayar = date('d-m-Y H:i:s', strtotime($datax['batasbayar']));
                     $tglmasuk = date('d-m-Y', strtotime($datax['tglmasuk']));
                     $tglkeluar = date('d-m-Y', strtotime($datax['tglkeluar']));

                     // Hitung ulang lama hari
                     $tglCheckIn = new DateTime($datax['tglmasuk']);
                     $tglCheckOut = new DateTime($datax['tglkeluar']);
                     $lamaMenginap = $tglCheckIn->diff($tglCheckOut)->days;

                     // Hitung ulang total bayar
                     $harga = floatval($datax['harga']);
                     $totalbayar = $harga * $lamaMenginap;

                     // Format total bayar
                     $formattedHarga = number_format($harga, 0, ',', '.');
                     $formattedTotalBayar = number_format($totalbayar, 0, ',', '.');

                     // Tampilkan baris data
                     echo "<tr>";
                     echo "<td><img src='../Savegambar/{$datax['gambar']}' alt='Gambar Kamar' class='img-thumbnail' style='width: 100px; height: auto;'></td>";
                     echo "<td>{$datax['idpesan']}</td>";
                     echo "<td>{$datax['tipe']}</td>";
                     echo "<td>Rp. $formattedHarga</td>";
                     echo "<td>{$lamaMenginap} malam</td>";
                     echo "<td>Rp. $formattedTotalBayar</td>";
                     echo "<td><span class='badge " . ($datax['status'] == 'Lunas' ? 'bg-success' : 'bg-warning text-dark') . "'>{$datax['status']}</span></td>";
                     echo "<td>";
                     if ($datax['status'] == 'Lunas' || $datax['status'] == 'Berhasil') { 
                         // Jika status "Lunas" atau "Berhasil", nonaktifkan tombol
                         echo "<button class='btn btn-success btn-sm' disabled>Lunas</button>";
                     } else if ($datax['status'] == 'Dibatalkan') {
                         // Jika status "Dibatalkan", tampilkan tombol "Tidak Lunas"
                         echo "<button class='btn btn-danger btn-sm' disabled>Tidak Lunas</button>";
                     } else {
                         // Jika status belum selesai, tampilkan tombol Bayar
                         echo "<form action='snap.php' method='POST' class='d-inline'>";
                         echo "<input type='hidden' name='idpesan' value='{$datax['idpesan']}'>";
                         echo "<input type='hidden' name='totalbayar' value='$totalbayar'>";
                         echo "<button type='submit' class='btn btn-primary btn-sm'>Bayar</button>";
                         echo "</form>";
                     }
                     echo "</td>";
                     echo "</tr>";
                 }
 
                 echo "</tbody>";
                 echo "</table>";
                 echo "</div>";
             }
         } catch (Exception $e) {
             echo "<p class='text-danger'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</p>";
         }
         ?>
     </div>
 </div>
