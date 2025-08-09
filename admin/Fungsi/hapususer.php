<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Pilihan 1: Memindahkan data ke tabel arsip
    $sql = $pdo->prepare("SELECT * FROM tamu WHERE idtamu = ?");
    $sql->execute([$id]);
    $data = $sql->fetch();
    
    if ($data) {
        $insertArsip = $pdo->prepare("INSERT INTO arsip_tamu (idtamu, username, email, nama, alamat, telepon) VALUES (?, ?, ?, ?, ?, ?)");
        $insertArsip->execute([$data['idtamu'], $data['username'], $data['email'], $data['nama'], $data['alamat'], $data['telepon']]);

        // Hapus data dari tabel tamu
        $deleteTamu = $pdo->prepare("DELETE FROM tamu WHERE idtamu = ?");
        $deleteTamu->execute([$id]);

        echo "<script>alert('User telah dihapus dan dipindahkan ke Riwayat User.'); document.location.href='../riwayatuser';</script>";
    } else {
        echo "<script>alert('Data tidak ditemukan.'); document.location.href='../datauser';</script>";
    }
}
?>
