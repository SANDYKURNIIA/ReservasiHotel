<?php
session_start();
require_once "fungsi/koneksi.php";
if (!isset($_SESSION['ceklog'])) {
?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Silakan Login</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Oops...',
                text: 'Silahkan Login Terlebih Dahulu!',
                icon: 'warning',
                timer: 2000,
                showConfirmButton: false,
                backdrop: '#ffffff',
            }).then(() => {
                window.location.replace('index.php');
            });
        </script>
    </body>
    </html>
<?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hotel Widjaya</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk sidebar */
        #sidebar {
            height: 100vmax;
            background: linear-gradient(135deg, #4e342e, #3e2723);
            padding-top: 20px;
        }

        .sidebar-link {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar-link:hover {
            background-color:hsl(0, 69.60%, 9.00%);
            border-radius: 5px;
        }
        /* Custom styling for sidebar header */
        #sidebar h2 {
            font-size: 26px;
            color: white;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .welcome-message {
            background: linear-gradient(135deg, #3e2723, #3e2723);
            color: white;
            text-align: center;
            width: 85vmax;
        }

        .btn-laporan {
            --bs-btn-color: #fff;
            --bs-btn-bg: rgb(62, 39, 35);
            --bs-btn-border-color: rgb(62, 39, 35);
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: rgb(95, 72, 68);
            --bs-btn-hover-border-color: rgb(95, 72, 68);
            --bs-btn-focus-shadow-rgb: 66, 70, 73;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: rgb(95, 72, 68);
            --bs-btn-active-border-color: rgb(95, 72, 68);
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #212529;
            --bs-btn-disabled-border-color: #212529;
        }
        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            #sidebar {
                width: 220px;
            }
            .main-content {
                margin-left: 0;
            }
            #sidebar h2 {
                font-size: 22px;
            }
        }
        
    </style>
</head>
<body>
<div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="p-3">
        <center><img src="../Gambar/logo.png" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;"></center>
            <ul class="list-unstyled">
                <li><a href="beranda.php" class="sidebar-link">Beranda Admin</a></li>
                <li><a href="detailkamar.php" class="sidebar-link">Detail Kamar</a></li>
                <li><a href="inputkamar.php" class="sidebar-link">Tambah Kamar</a></li>
                <li><a href="inputfasilitas.php" class="sidebar-link">Tambah Fasilitas</a></li>
                <li><a href="fasilitas.php" class="sidebar-link">Data Fasilitas</a></li>
                <li><a href="datauser.php" class="sidebar-link">Data User</a></li>
                <li><a href="riwayatuser.php" class="sidebar-link">Riwayat User</a></li>
                <li><a href="konfirmasi.php" class="sidebar-link">Konfirmasi Pesanan</a></li>
                <li><a href="transaksiberhasil.php" class="sidebar-link">Transaksi Sukses</a></li>
                <li><a href="transaksibatal.php" class="sidebar-link">Transaksi Batal</a></li>
                <li><a class="sidebar-link" href="fungsi/proseskeluar">Keluar</a></li>
            </ul>
        </div>
        <div class="main-content">
                <!-- Welcome Message -->
                <div class="welcome-message">
                    <h2>Selamat Datang di Beranda Admin</h2>
                    <p>Kelola sistem hotel Anda dengan mudah dan efisien.</p>
                </div>

    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
