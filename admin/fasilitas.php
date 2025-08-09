<?php
require_once('view/header.php');
require_once('fungsi/koneksi.php'); // Pastikan koneksi menggunakan PDO sudah benar

// Ambil fasilitas dari database menggunakan PDO
$sql = $pdo->prepare("SELECT * FROM fasilitas");
$sql->execute();
$fasilitas = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-center mb-4">Edit Fasilitas Kami</h2>
<div class="text-end mb-3">
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Fasilitas</th>
      <th>Deskripsi</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($fasilitas as $row): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nama_fasilitas']; ?></td>
        <td><?php echo $row['deskripsi']; ?></td>
        <td><img src="../Gambar/<?php echo $row['gambar']; ?>" alt="Fasilitas Image" width="100"></td>
        <td>
          <a href="edit_fasilitas.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
          <a href="Fungsi/hapusfasilitas.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
?>
