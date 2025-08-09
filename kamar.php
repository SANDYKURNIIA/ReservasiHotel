<?php
require_once ('view/header.php');
?>

<h2 class="text-center my-4">Daftar Kamar</h2>
<div class="row">
    <?php
        $sql = $pdo->query("SELECT * FROM kamar");
        while($data = $sql->fetch()) {
            $id = $data['idkamar'];
            $tipe = $data['tipe'];
            $persediaan = $data['ketersediaan']; // Stok kamar langsung diambil dari view
            $harga = $data['harga'];
            $gambar = $data['gambar'];
            $angka = number_format($harga, 0, ",", ".");
    ?>

    <div class="col-sm-3 mt-5">
        <div class="card h-100">
            <img src="Savegambar/<?php echo $gambar; ?>" class="card-img-top" alt="Gambar <?php echo htmlspecialchars($tipe); ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title text-center"><?php echo htmlspecialchars($tipe); ?></h5>
                <p class="card-text text-center text-success font-weight-bold">Rp. <?php echo $angka; ?></p>
                <p class="card-text text-center">Tersedia: <strong><?php echo $persediaan; ?></strong> Kamar</p>
            </div>
        </div>
    </div>

    <?php
        }
    ?>
</div>
