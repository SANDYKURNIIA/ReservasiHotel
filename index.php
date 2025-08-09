<?php
    require_once "view/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">
        function pilih() {
            // Ambil elemen select dan input
            var selectElement = document.getElementById('selek');
            var hargaInput = document.forms['opsi'].harga;
            var tipeInput = document.forms['opsi'].tipex;

            // Ambil harga dari value option yang dipilih
            var selectedValue = selectElement.value;

            // Ambil teks tipe dari option yang dipilih
            var selectedText = selectElement.options[selectElement.selectedIndex].text;

            // Isi input harga dan tipe
            hargaInput.value = selectedValue;
            tipeInput.value = selectedText;
        }
    </script>
</head>
<body>
<div class="cover">
    <img src="Gambar/Cover.png" alt="Hotel Cover">
    <div class="booking-form mb-5">
        <form name="opsi" action="user/pemesanan" method="post">
            <div>
                <label for="checkin">Check In</label>
                <input type="date" name="checkin" id="checkin" required>
            </div>
            <div>
                <label for="checkout">Check Out</label>
                <input type="date" name="checkout" id="checkout" required>
            </div>
            <div>
                <label for="Type">Type</label>
                <select name="tipex" id="selek" required="required" onchange="pilih()" style="font-weight: bold;">
                    <option selected="selected" disabled="disabled">-Pilih-</option>
                    <option value="Rp 400.000">Superior</option>
                    <option value="Rp 450.000">Deluxe</option>
                    <option value="Rp 700.000">Junior Suite</option>
                    <option value="Rp 1.200.000">Executive</option>
                </select>
            </div>
            <div>
                <label for="children">Harga/Malam</label>
                <input type="text" name="harga" readonly style="width: 150px; font-weight: bold;">
            <input type="hidden" name="tipex" value="">
            </div>
            <div>
            <input type="submit" value="Pesan"style="background:#198754;color:white;padding:10px;width: 300px;border:1px solid #fff;">
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php
require_once "view/footer.php";
