<?php
require_once('view/header.php');
include('Fungsi/koneksi.php');

// Ambil ID fasilitas dari URL
$id = $_GET['id'];

// Query menggunakan PDO untuk mengambil data fasilitas berdasarkan ID
$sql = $pdo->prepare("SELECT * FROM fasilitas WHERE id = :id");
$sql->bindParam(':id', $id, PDO::PARAM_INT); // Bind ID ke parameter query
$sql->execute();

// Ambil data fasilitas
$row = $sql->fetch(PDO::FETCH_ASSOC);

// Pastikan data ada sebelum digunakan
if (!$row) {
    echo "Fasilitas tidak ditemukan.";
    exit;
}
?>

<h2 class="text-center mb-4">Edit Fasilitas</h2>

<form action="Fungsi/updatefasilitas.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

  <div class="form-group">
    <label for="nama_fasilitas">Nama Fasilitas</label>
    <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas" value="<?php echo $row['nama_fasilitas']; ?>" required>
  </div>

  <div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $row['deskripsi']; ?></textarea>
  </div>

  <div class="form-group">
    <label for="gambar">Gambar</label>
    <input type="file" class="form-control" id="gambar" name="gambar">
    <img src="../Gambar/<?php echo $row['gambar']; ?>" alt="Fasilitas Image" width="100">
  </div>

  <button type="submit" class="btn btn-primary">Update Fasilitas</button>
</form>

<?php
// Menutup koneksi PDO
$pdo = null;
?>
