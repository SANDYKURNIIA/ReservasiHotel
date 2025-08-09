<?php
require_once ('view/header.php');
$query = "SELECT * FROM fasilitas";
$sql = $pdo->prepare($query);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-center mb-4">Fasilitas Kami</h2>
<div class="row g-4 mt-3">
  <?php foreach ($result as $row): ?>
    <div class="col-sm-6 col-lg-4">
      <div class="card h-100">
        <img src="../Gambar/<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="Fasilitas">
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($row['nama_fasilitas']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php
?>
