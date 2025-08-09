<?php
	require_once "view/header.php";
?>

<div class="container">
	<div>
		<div>
					<h3 class="text-center mb-4">Tambah Kamar</h3>
				</div>
				<div class="card-body">
					<form method="post" action="Fungsi/prosesinput" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="tipe" class="form-label">Tipe</label>
							<select name="tipe" id="tipe" class="form-select" required>
								<option value="" disabled selected>-- Pilih --</option>
								<option>Superior</option>
								<option>Deluxe</option>
								<option>Junior Suite</option>
								<option>Executive</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label for="jumlah" class="form-label">Ketersediaan</label>
							<input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah kamar" required>
						</div>
						<div class="form-group mb-3">
							<label for="harga" class="form-label">Harga</label>
							<input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan harga kamar" required>
						</div>
						<div class="form-group mb-3">
							<label for="gambar" class="form-label">Gambar</label>
							<input type="file" name="gambar" id="gambar" class="form-control" required>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-success">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	require_once "view/footer.php";
?>
