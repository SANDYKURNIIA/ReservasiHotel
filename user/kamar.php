<?php
require_once "view/header.php";
?>
<h2 class="text-center my-4">Daftar Kamar</h2>
<div class="row">
    <?php
    // Ambil data kamar dari database
    $sql = $pdo->query("SELECT * FROM kamar");

    // Periksa apakah ada data kamar
    if ($sql->rowCount() > 0) {
        while ($data = $sql->fetch()) {
            // Amankan output untuk mencegah XSS
            $tipe = htmlspecialchars($data['tipe']);
            $harga = number_format($data['harga'], 0, ",", "."); // Format harga
            $ketersediaan = htmlspecialchars($data['ketersediaan']);
            $gambar = htmlspecialchars($data['gambar']);
    ?>
    <div class="col-md-3 col-sm-6 mt-5">
        <div class="card h-100 shadow-sm">
            <!-- Gambar kamar -->
            <img src="../Savegambar/<?php echo $gambar; ?>" 
                 class="card-img-top" 
                 alt="Gambar <?php echo $tipe; ?>" 
                 style="height: 200px; object-fit: cover;">
            
            <!-- Informasi kamar -->
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo $tipe; ?></h5>
                <p class="card-text text-center text-success font-weight-bold">Rp. <?php echo $harga; ?></p>
                <p class="card-text text-center">Tersedia: <strong><?php echo $ketersediaan; ?></strong> Kamar</p>
                
                <!-- Tombol pemilihan kamar -->
                <div class="text-center mt-3">
                    <a href="index.php?tipe=<?php echo urlencode($tipe); ?>" class="btn btn-primary">Pilih Kamar</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        // Jika tidak ada data kamar
    ?>
    <div class="col-12">
        <p class="text-center text-muted mt-5">Tidak ada kamar yang tersedia saat ini.</p>
    </div>
    <?php
    }
    ?>
</div>
