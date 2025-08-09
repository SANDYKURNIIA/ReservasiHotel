<?php
require_once "view/header.php"; 
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data user berdasarkan username agar tidak terhindar sql injection
    $stmt = $pdo->prepare("SELECT * FROM tamu WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifikasi password dengan password_verify
        if (password_verify($password, $user['password'])) {
            // Jika login berhasil, set session
            $_SESSION['user'] = $user['idtamu'];
            echo "<script>swal({
                    type: 'success',
                    title: 'Login Sukses!',
                    showConfirmButton: false,
                    backdrop: '#ffffff',
                    });
                    window.setTimeout(function(){
                        window.location.replace('user/');
                    } ,1500); </script>";
        } else {
            // Password salah
            echo "<script>swal({
                    type: 'error',
                    title: 'Login Gagal!',
                    showConfirmButton: false,
                    backdrop: '#ffffff',
                    });
                    window.setTimeout(function(){
                        window.location.replace('login');
                    } ,1500); </script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>swal({
                type: 'error',
                title: 'Login Gagal!',
                showConfirmButton: false,
                backdrop: '#ffffff',
                });
                window.setTimeout(function(){
                    window.location.replace('login');
                } ,1500); </script>";
    }
}
?>
<div class="background">
<div class="container">
    <center><img src="Gambar/user.png" class="card-img-top mt-3 logo-img" alt="Logo" style="width: 70px;"></center>

    <form action="login" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>
        <input type="submit" name="submit" value="Login" style="background:#198754; color: white;">
    </form>
    <div class="link">
        <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </div>
</div>