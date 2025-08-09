<?php
require_once('view/header.php');
?>

<style>
    .stat-card {
        border-radius: 10px;
        padding: 20px;
        color: white;
        margin-bottom: 20px;
    }
    .bg-blue {
        background: #007bff;
    }
    .bg-orange {
        background: #fd7e14;
    }
    .bg-green {
        background: #28a745;
    }
    .card-header {
        border-radius: 10px 10px 0 0;
    }
</style>

<h2 class="text-center my-4">Beranda Admin</h2>

<div class="container mb-5">
    <div class="row mb-4">
        <!-- Total User -->
        <?php
        // Pastikan koneksi PDO sudah benar
        if ($pdo) {
            $totalUser = $pdo->query("SELECT COUNT(*) AS total_user FROM tamu")->fetch()['total_user'];
        }
        ?>
        <div class="col-md-4">
            <div class="stat-card bg-blue text-center">
                <h4>Total User</h4>
                <h2><?php echo $totalUser; ?></h2>
            </div>
        </div>

        <!-- Jumlah Tipe Kamar -->
        <?php
        // Mengambil jumlah tipe kamar
        if ($pdo) {
            $jumlahTipeKamar = $pdo->query("SELECT COUNT(DISTINCT tipe) AS total_tipe FROM kamar")->fetch()['total_tipe'];
        }
        ?>
        <div class="col-md-4">
            <div class="stat-card bg-orange text-center">
                <h4>Jumlah Tipe Kamar</h4>
                <h2><?php echo $jumlahTipeKamar; ?></h2>
            </div>
        </div>

        <!-- Transaksi Sukses -->
        <?php
        // Mengambil jumlah transaksi sukses
        if ($pdo) {
            $transaksiSukses = $pdo->query("SELECT COUNT(*) AS sukses FROM pemesanan WHERE status = 'berhasil'")->fetch()['sukses'];
        }
        ?>
        <div class="col-md-4">
            <div class="stat-card bg-green text-center">
                <h4>Transaksi Sukses</h4>
                <h2><?php echo $transaksiSukses; ?></h2>
            </div>
        </div>
    </div>

    <!-- Chart Total Pemasukan -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-purple text-white text-center">
                    <b><h5>Statistik Total Pemasukan</h5></b>
                </div>
                <div class="card-body">
                    <canvas id="totalPemasukanChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Ambil data pemasukan per bulan dari database
$dataChart = [
    'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    'pemasukan' => array_fill(0, 12, 0) // Isi default dengan 0
];

// Query untuk mendapatkan total pemasukan per bulan
if ($pdo) {
    $query = "SELECT MONTH(tglpesan) AS bulan, SUM(totalbayar) AS total_pemasukan 
              FROM pemesanan 
              WHERE YEAR(tglpesan) = 2025 
              GROUP BY MONTH(tglpesan) 
              ORDER BY bulan";

    $stmt = $pdo->query($query);
    
    // Proses hasil query dan set dataChart
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dataChart['pemasukan'][$row['bulan'] - 1] = $row['total_pemasukan'];
    }
}
?>

<?php
require_once('view/footer.php');
?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data dari PHP untuk chart
    const dataChart = {
        labels: <?php echo json_encode($dataChart['labels']); ?>,
        datasets: [{
            label: 'Total Pemasukan (Rp)',
            data: <?php echo json_encode($dataChart['pemasukan']); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            tension: 0.4, // Membuat garis menjadi melengkung
        }]
    };

    // Konfigurasi chart
    const config = {
        type: 'line', // Pilihan: 'line', 'bar', dll.
        data: dataChart,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Total Pemasukan Per Bulan (Tahun 2024)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    };

    // Render chart
    const ctx = document.getElementById('totalPemasukanChart').getContext('2d');
    const totalPemasukanChart = new Chart(ctx, config);
</script>
