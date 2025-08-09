<?php
require_once "view/header.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3 class="text-center mb-4">Data User</h3>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $pdo->query("SELECT * FROM tamu");
                while ($caridata = $sql->fetch()) {
                    $id = $caridata['idtamu'];
                    $username = $caridata['username'];
                    $email = $caridata['email'];
                    $nama = $caridata['nama'];
                    $alamat = $caridata['alamat'];
                    $telepon = $caridata['telepon'];
                ?>
                <tr class="text-center">
                    <td><?php echo htmlspecialchars($id); ?></td>
                    <td><?php echo htmlspecialchars($username); ?></td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <td><?php echo htmlspecialchars($nama); ?></td>
                    <td><?php echo htmlspecialchars($alamat); ?></td>
                    <td><?php echo htmlspecialchars($telepon); ?></td>
                    <td>
                        <a href="fungsi/hapususer?id=<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus User?')">Hapus</a>
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
require_once "view/footer.php";
?>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
