<?php
require_once "view/header.php";
include "Fungsi/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3 class="text-center mb-4">Arsip User</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Waktu Dihapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $pdo->query("SELECT * FROM arsip_tamu");
                while ($data = $sql->fetch()) {
                    echo "<tr class='text-center'>
                        <td>" . htmlspecialchars($data['idtamu']) . "</td>
                        <td>" . htmlspecialchars($data['username']) . "</td>
                        <td>" . htmlspecialchars($data['email']) . "</td>
                        <td>" . htmlspecialchars($data['nama']) . "</td>
                        <td>" . htmlspecialchars($data['alamat']) . "</td>
                        <td>" . htmlspecialchars($data['telepon']) . "</td>
                        <td>" . htmlspecialchars($data['waktu_dihapus']) . "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once "view/footer.php";
?>
</body>
</html>
