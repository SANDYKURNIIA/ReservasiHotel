<?php
include 'view/header.php'; // Pastikan file header dimuat terlebih dahulu
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<h2 class="text-center my-4">Daftar Kamar</h2>

<div class="container mb-5">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $pdo->query("SELECT * FROM view_kamar");
                while($data = $sql->fetch()) {
                    $id = $data['idkamar'];
                    $tipe = $data['tipe'];
                    $persediaan = $data['ketersediaan']; 
                    $harga = $data['harga'];
                    $gambar = $data['gambar'];
                    $angka = number_format($harga, 0, ",", ".");
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center">
                        <img src="../Savegambar/<?php echo $gambar; ?>" alt="Gambar <?php echo htmlspecialchars($tipe); ?>" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td><?php echo htmlspecialchars($tipe); ?></td>
                    <td class="text-center"><?php echo $persediaan; ?></td>
                    <td class="text-end">Rp. <?php echo $angka; ?></td>
                    <td class="text-center">
                        <a href="editkamar.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="Fungsi/deletekamar.php?id=<?php echo $id; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once 'view/footer.php';
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
