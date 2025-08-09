<?php
session_start();
require_once "../fungsi/koneksi.php";

// Fungsi untuk menyimpan perubahan profil
function simpanProfile($pdo, $id, $nama, $email, $alamat, $telepon, $password) {
    // Query untuk memperbarui data pengguna
    $update_sql = "UPDATE tamu SET nama = :nama, email = :email, alamat = :alamat, telepon = :telepon, password = :password WHERE idtamu = :idtamu";
    
    // Menyiapkan query dan parameter
    $stmt = $pdo->prepare($update_sql);
    
    // Mengeksekusi query dengan data baru
    $stmt->execute([
        ':nama' => $nama,
        ':email' => $email,
        ':alamat' => $alamat,
        ':telepon' => $telepon,
        ':password' => $password,
        ':idtamu' => $id
    ]);
}

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.replace('../')</script>";
    exit();
}

$ambil = $_SESSION['user'];
$sql = $pdo->query("SELECT * FROM tamu WHERE idtamu='$ambil'");
$data = $sql->fetch();
$id = $data['idtamu'];
$username = $data['username'];
$email = $data['email'];
$alamat = $data['alamat'];
$telepon = $data['telepon'];
$password = $data['password'];
$nama = $data['nama'];

// Jika form disubmit, panggil fungsi simpanProfile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['nama'];
    $new_email = $_POST['email'];
    $new_alamat = $_POST['alamat'];
    $new_telepon = $_POST['telepon'];
    $new_password = $_POST['password'];

    // Hanya perbarui password jika ada perubahan
    if (!empty($new_password)) {
        // Enkripsi password baru
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    } else {
        // Jika password kosong, gunakan password lama
        $new_password = $password;
    }

    // Panggil fungsi untuk menyimpan perubahan profil
    simpanProfile($pdo, $id, $new_name, $new_email, $new_alamat, $new_telepon, $new_password);

    // Redirect setelah data disimpan
    header("Location: profil.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styling.css">
    <title>Edit Profil</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="profil.php">
                <center>
                    <img src="../Gambar/logo.png" 
                         alt="Foto Profil" 
                         style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
                </center>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Edit Profil</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($nama) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required><?= htmlspecialchars($alamat) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= htmlspecialchars($telepon) ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru (Opsional)</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Isi jika ingin mengubah password.</small>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
           <a href="profil.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
