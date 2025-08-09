<?php
require_once 'koneksi.php'; // Pastikan file koneksi ke database sudah di-include

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar terlebih dahulu
    $sql = $pdo->prepare("SELECT gambar FROM view_kamar WHERE idkamar = ?");
    $sql->execute([$id]);
    $data = $sql->fetch();

    if ($data && file_exists("../Savegambar/" . $data['gambar'])) {
        unlink("../Savegambar/" . $data['gambar']); // Hapus file gambar
    }

    // Hapus data dari database
    $delete_sql = $pdo->prepare("DELETE FROM kamar WHERE idkamar = ?");
    $delete_sql->execute([$id]);

    header("Location: ../beranda.php"); // Redirect ke halaman utama
    exit;
} else {
    die("ID kamar tidak ditemukan!");
}
?>
