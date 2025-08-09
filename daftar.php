<?php
require_once "view/header.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : null;
    $alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : null;
    $telepon = isset($_POST['telepon']) ? trim($_POST['telepon']) : null;
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : null;

    if (empty($username) || empty($email) || empty($nama) || empty($alamat) || empty($telepon) || empty($pass)) {
        $error = "Semua kolom harus diisi!";
    } else {
        try {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Cek apakah username atau email sudah digunakan
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM tamu WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $error = "Username atau email sudah digunakan!";
            } else {
                // Lanjutkan proses registrasi
                $stmt = $pdo->prepare("INSERT INTO tamu (username, email, nama, alamat, telepon, password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$username, $email, $nama, $alamat, $telepon, $hashed_password]);

                echo "<script>
                        swal({
                            type: 'success',
                            title: 'Registrasi berhasil!',
                            showConfirmButton: false,
                            backdrop: '#ffffff',
                        });
                        window.setTimeout(function(){
                            window.location.replace('login.php');
                        }, 1500);
                      </script>";
            }
        } catch (PDOException $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- File CSS Custom -->
    <link href="style.css" rel="stylesheet"> <!-- Ganti 'style.css' dengan nama file CSS Anda -->
</head>
<body class="bg-light">
<div class="background"> <!-- Tambahkan class cover untuk background -->
    <div class="container mt-5">
        <div class="">
            <div>
                <div class="card shadow">
                    <div class="card-header bg-white text-black text-center">
                        <h3 class="mb-0">Form Registrasi</h3>
                    </div>
                    <div class="card-body">
                        <!-- Tampilkan pesan error jika ada -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="daftar.php" method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">No Hp</label>
                                <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan no hp" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="pass" placeholder="Masukkan password" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success w-100">Daftar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Sudah punya akun? <a href="login.php" class="text-success">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>