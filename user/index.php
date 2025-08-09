<?php
require_once "view/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tamu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function updateCheckoutMin() {
            var checkinDate = document.getElementById('checkin').value;
            document.getElementById('checkout').min = checkinDate;
            calculateTotalBayar();
        }

        function updateHarga() {
            var tipeKamar = document.getElementById("tipe").value;
            var hargaInput = document.getElementById("harga");
            var options = document.getElementById("tipe").options;

            for (var i = 0; i < options.length; i++) {
                if (options[i].value === tipeKamar) {
                    var harga = options[i].getAttribute("data-harga");
                    hargaInput.value = "Rp. " + new Intl.NumberFormat().format(harga);
                    break;
                }
            }
            calculateTotalBayar();
        }

        function calculateTotalBayar() {
            var hargaInput = document.getElementById("harga").value;
            var checkinDate = document.getElementById("checkin").value;
            var checkoutDate = document.getElementById("checkout").value;
            var totalInput = document.getElementById("total");

            if (hargaInput && checkinDate && checkoutDate) {
                var harga = parseFloat(hargaInput.replace(/[^0-9]/g, '')); // Hapus format "Rp." dan koma
                var checkin = new Date(checkinDate);
                var checkout = new Date(checkoutDate);

                var lamaMenginap = (checkout - checkin) / (1000 * 60 * 60 * 24); // Hitung selisih hari

                if (lamaMenginap > 0) {
                    var totalBayar = harga * lamaMenginap;
                    totalInput.value = "Rp. " + new Intl.NumberFormat().format(totalBayar);
                } else {
                    totalInput.value = "Rp. 0";
                }
            } else {
                totalInput.value = "Rp. 0";
            }
        }

        window.onload = function () {
            // Menampilkan harga berdasarkan tipe kamar yang dipilih jika ada query tipe yang dikirimkan
            <?php if (isset($_GET['tipe'])): ?>
                var selectedTipe = "<?php echo htmlspecialchars($_GET['tipe']); ?>";
                var options = document.getElementById("tipe").options;
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value === selectedTipe) {
                        var harga = options[i].getAttribute("data-harga");
                        document.getElementById("harga").value = "Rp. " + new Intl.NumberFormat().format(harga);
                        break;
                    }
                }
            <?php endif; ?>
        };
    </script>
</head>
<body>
<div class="cover">
    <img src="../Gambar/cover.png" alt="Hotel Cover" style="width: 100%; height: auto;">
    <div class="booking-form mt-4 mb-5">
        <form name="opsi" action="pemesanan.php" method="post" class="p-4 border rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="checkin" class="form-label">Check In</label>
                <input type="date" name="checkin" id="checkin" class="form-control" required onchange="updateCheckoutMin()">
            </div>
            <div class="mb-3">
                <label for="checkout" class="form-label">Check Out</label>
                <input type="date" name="checkout" id="checkout" class="form-control" required onchange="calculateTotalBayar()">
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe Kamar</label>
                <select id="tipe" name="tipe" class="form-control" required onchange="updateHarga()">
                    <option value="">Pilih Tipe Kamar</option>
                    <?php
                    $sql = $pdo->query("SELECT * FROM kamar");
                    while ($data = $sql->fetch()) {
                        $tipe = htmlspecialchars($data['tipe']);
                        $harga = htmlspecialchars($data['harga']);
                        $selected = (isset($_GET['tipe']) && $_GET['tipe'] === $tipe) ? 'selected' : '';
                        echo "<option value=\"$tipe\" data-harga=\"$harga\" $selected>$tipe</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga/Malam</label>
                <input type="text" name="harga" id="harga" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total Bayar</label>
                <input type="text" name="total" id="total" class="form-control" readonly>
            </div>
            <button type="submit" name="submit" class="btn btn-success w-100">Pesan</button>
        </form>
    </div>
</div>
</body>
</html>
