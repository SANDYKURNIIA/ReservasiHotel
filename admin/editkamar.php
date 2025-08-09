<?php
require_once 'fungsi/koneksi.php'; // Pastikan file koneksi ke database sudah di-include

// Ambil data berdasarkan idkamar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM view_kamar WHERE idkamar = ?");
    $sql->execute([$id]);
    $data = $sql->fetch();

    if (!$data) {
        die("Data tidak ditemukan!");
    }
}

// Proses update data
if (isset($_POST['update'])) {
    $tipe = $_POST['tipe'];
    $ketersediaan = $_POST['ketersediaan'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];

    if ($gambar) {
        $target_dir = "../Savegambar/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
    } else {
        $gambar = $data['gambar']; // Gunakan gambar lama jika tidak ada perubahan
    }

    $update_sql = $pdo->prepare("UPDATE kamar SET tipe = ?, ketersediaan = ?, harga = ?, gambar = ? WHERE idkamar = ?");
    $update_sql->execute([$tipe, $ketersediaan, $harga, $gambar, $id]);

    header("Location: beranda.php"); // Redirect ke halaman utama
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Edit Data Kamar</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo $data['tipe']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="ketersediaan" class="form-label">Ketersediaan</label>
            <input type="number" class="form-control" id="ketersediaan" name="ketersediaan" value="<?php echo $data['ketersediaan']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $data['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            <img src="../Savegambar/<?php echo $data['gambar']; ?>" alt="Gambar Kamar" style="width: 100px; margin-top: 10px;">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="berandaadmin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
