<!DOCTYPE html>
<html>
<head>
    <title>Pemesanan Kamar</title>
    <script src="../lib/sweet.js"></script>
</head>
<body>
<?php
session_start();
require_once "../fungsi/koneksi.php";

// Validasi jika pengguna belum login
if (!isset($_SESSION['user'])) {
    echo "<script>
        swal({
            title: 'Oops...?',
            text: 'Silahkan Login Terlebih Dahulu!',
            showConfirmButton: false,
            type: 'warning',
            backdrop: 'rgb(255, 255, 255)'
        });
        window.setTimeout(function(){
            window.location.replace('../login.php');
        }, 2000); 
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Ambil data dari form
    $tanggalCheckIn = $_POST['checkin'] ?? '';
    $tanggalCheckOut = $_POST['checkout'] ?? '';
    $tipe = $_POST['tipe'] ?? '';
    $harga = floatval(preg_replace('/[^0-9.]/', '', $_POST['harga'] ?? '')); // Validasi harga

    // Validasi input form
    if (empty($tanggalCheckIn) || empty($tanggalCheckOut)) {
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Tanggal Check-In dan Check-Out wajib diisi!',
                type: 'warning',
                backdrop: 'rgb(255, 255, 255)'
            }).then(() => {
                window.location.replace('index.php');
            });
        </script>";
        exit;
    }

    $tglCheckIn = new DateTime($tanggalCheckIn);
    $tglCheckOut = new DateTime($tanggalCheckOut);
    $lamaMenginap = $tglCheckIn->diff($tglCheckOut)->days;

    if ($lamaMenginap <= 0) {
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Tanggal Check-Out harus lebih besar dari Tanggal Check-In!',
                type: 'error',
                backdrop: 'rgb(255, 255, 255)'
            }).then(() => {
                window.location.replace('index.php');
            });
        </script>";
        exit;
    }

    $totalBiaya = $harga * $lamaMenginap;

    // Ambil data user dari sesi
    $user = $_SESSION['user'];
    $sqlUser = $pdo->prepare("SELECT * FROM tamu WHERE idtamu = :idtamu");
    $sqlUser->execute(['idtamu' => $user]);
    $dataUser = $sqlUser->fetch(PDO::FETCH_ASSOC);

    if (!$dataUser) {
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Data pengguna tidak ditemukan!',
                type: 'error',
                backdrop: 'rgb(255, 255, 255)'
            }).then(() => {
                window.location.replace('../');
            });
        </script>";
        exit;
    }

    // Cari id kamar berdasarkan tipe
    $sqlKamar = $pdo->prepare("SELECT idkamar, ketersediaan FROM kamar WHERE tipe = :tipe");
    $sqlKamar->execute(['tipe' => $tipe]);
    $kamarData = $sqlKamar->fetch(PDO::FETCH_ASSOC);

    if (!$kamarData) {
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Kamar tidak ditemukan!',
                type: 'error',
                backdrop: 'rgb(255, 255, 255)'
            }).then(() => {
                window.location.replace('index.php');
            });
        </script>";
        exit;
    }

    $idkamar = $kamarData['idkamar'];
    $stokKamar = $kamarData['ketersediaan'];

    if ($stokKamar <= 0) {
        echo "<script>
            swal({
                title: 'Maaf!',
                text: 'Stok kamar habis!',
                type: 'warning',
                backdrop: 'rgb(255, 255, 255)'
            }).then(() => {
                window.location.replace('index.php');
            });
        </script>";
        exit;
    }

    try {
        // Mulai transaksi
        $pdo->beginTransaction();

        // Kurangi stok di tabel kamar
        $sqlUpdateStok = $pdo->prepare("
            UPDATE kamar 
            SET ketersediaan = ketersediaan - 1 
            WHERE idkamar = :idkamar AND ketersediaan > 0
        ");
        $sqlUpdateStok->execute(['idkamar' => $idkamar]);

        if ($sqlUpdateStok->rowCount() == 0) {
            throw new Exception("Gagal mengurangi stok kamar. Stok mungkin telah habis.");
        }

        // Masukkan data ke tabel pemesanan
        $sqlInsert = $pdo->prepare("
            INSERT INTO pemesanan 
            (tglpesan, batasbayar, idkamar, tipe, harga, ketersediaan, idtamu, nama, alamat, telepon, tglmasuk, tglkeluar, lamahari, totalbayar, status, jamexpire) 
            VALUES 
            (:tglpesan, :batasbayar, :idkamar, :tipe, :harga, :ketersediaan, :idtamu, :nama, :alamat, :telepon, :tglmasuk, :tglkeluar, :lamahari, :totalbayar, :status, :jamexpire)
        ");
        $sqlInsert->execute([
            'tglpesan' => date('Y-m-d H:i:s'),
            'batasbayar' => date('Y-m-d H:i:s', strtotime('+1 day')),
            'idkamar' => $idkamar,
            'tipe' => $tipe,
            'harga' => $harga,
            'ketersediaan' => 1,
            'idtamu' => $dataUser['idtamu'],
            'nama' => $dataUser['nama'],
            'alamat' => $dataUser['alamat'],
            'telepon' => $dataUser['telepon'],
            'tglmasuk' => $tanggalCheckIn,
            'tglkeluar' => $tanggalCheckOut,
            'lamahari' => $lamaMenginap,
            'totalbayar' => $totalBiaya,
            'status' => 'Pending',
            'jamexpire' => date('H:i:s', strtotime('+5 hours'))
        ]);

        // Commit transaksi
        $pdo->commit();

        echo "<script>
            swal({
                title: 'Sukses!',
                text: 'Pemesanan Kamar Terkirim!',
                type: 'success',
                button: false,
                backdrop: '#ffffff'
            });
            window.setTimeout(function() {
                window.location.replace('../user/datapesanan');
            }, 1500);
        </script>";
    } catch (Exception $e) {
        // Rollback transaksi
        $pdo->rollBack();
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Gagal menyimpan data! " . $e->getMessage() . "',
                type: 'error',
                button: 'OK',
                backdrop: '#ffffff'
            }).then(() => {
                window.location.replace('index.php');
            });
        </script>";
    }
}
?>
</body>
</html>
