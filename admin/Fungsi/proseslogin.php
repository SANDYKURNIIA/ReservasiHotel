<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script type="text/javascript" src="../../lib/sweet.js"></script>
</head>
<body>

<?php
    include "koneksi.php";

    // Mengambil input dari form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    try {
        $stmt = $pdo->prepare("CALL loginAdmin(:username, :password)");
        $stmt->execute([
            'username' => $user,
            'password' => $pass
        ]);
        $akses = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($akses) {
            session_start();
            $_SESSION['ceklog'] = $akses['username'];
            echo "<script>
                swal({
                    type: 'success',
                    title: 'Login Sukses!',
                    showConfirmButton: false,
                    backdrop: 'rgb(255, 255, 255)',
                });
                window.setTimeout(function() {
                    window.location.replace('../beranda');
                }, 1500);
            </script>";
        } else {
            echo "<script>
                swal({
                    type: 'error',
                    title: 'Login Gagal!',
                    text: 'Username atau password salah!',
                    showConfirmButton: false,
                    backdrop: 'rgb(255, 255, 255)',
                });
                window.setTimeout(function() {
                    window.location.replace('../');
                }, 1500);
            </script>";
        }
    } catch (PDOException $e) {
        // Tangani error
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
?>

</body>
</html>
