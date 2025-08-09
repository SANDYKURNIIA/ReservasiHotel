<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript" src="../../lib/sweet.js"></script>
</head>
<body>
<?php
include('koneksi.php');

// Ambil data dari form
$id = $_POST['id'];
$nama_fasilitas = $_POST['nama_fasilitas'];
$deskripsi = $_POST['deskripsi'];

// Cek apakah gambar lama ada dalam POST
$gambar_lama = isset($_POST['gambar_lama']) ? $_POST['gambar_lama'] : null;

// Proses gambar (jika ada gambar baru)
if ($_FILES['gambar']['name']) {
    // Tentukan nama file gambar baru tanpa path
    $gambar_baru = basename($_FILES['gambar']['name']);

    // Cek apakah folder 'Gambar/' ada, jika tidak, buat
    if (!is_dir('../../Gambar/')) {
        mkdir('../Gambar/', 0777, true);
    }

    // Cek apakah ada gambar lama, hapus gambar lama jika ada
    if ($gambar_lama && file_exists('../Gambar/' . $gambar_lama)) {
        unlink('../Gambar/' . $gambar_lama);
    }

    // Cek ukuran file (maksimal 5MB)
    if ($_FILES['gambar']['size'] > 5000000) {
        die('File terlalu besar!');
    }

    // Periksa apakah file gambar valid (ekstensi yang diperbolehkan)
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($file_extension), $allowed_types)) {
        die('Ekstensi file tidak valid!');
    }

    // Pindahkan gambar baru ke folder 'Gambar'
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], '../../Gambar/' . $gambar_baru)) {
        // Gambar berhasil di-upload
    } else {
        echo "Terjadi kesalahan saat meng-upload file. Pastikan folder 'Gambar/' memiliki izin yang cukup.";
        exit;
    }
    
    // Set gambar ke nama file baru
    $gambar = $gambar_baru;
} else {
    // Jika tidak ada gambar baru, gunakan gambar lama
    $gambar = $gambar_lama;
}

// Update fasilitas menggunakan PDO
try {
    // Persiapkan query untuk update fasilitas
    $sql = $pdo->prepare("UPDATE fasilitas SET nama_fasilitas = :nama_fasilitas, deskripsi = :deskripsi, gambar = :gambar WHERE id = :id");
    
    // Binding parameter
    $sql->bindParam(':nama_fasilitas', $nama_fasilitas, PDO::PARAM_STR);
    $sql->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
    $sql->bindParam(':gambar', $gambar, PDO::PARAM_STR);
    $sql->bindParam(':id', $id, PDO::PARAM_INT);

    // Eksekusi query
    $sql->execute();

    // Tampilkan SweetAlert
    echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Fasilitas berhasil diperbarui.',
                type: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../fasilitas.php'; // Redirect setelah OK
            });
          </script>";
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}

?>
