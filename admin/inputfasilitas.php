<?php
require_once('view/header.php');
?>
<div class="container">
<h2 class="text-center mb-4">Tambah Fasilitas</h2>

<form method="POST" action="Fungsi/prosesinputfasilitas" enctype="multipart/form-data">
<div class="form-group mb-3">
        <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
        <input type="text" name="nama_fasilitas" id="nama_fasilitas" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" name="gambar" id="gambar" class="form-control">
    </div>
    <center><button type="submit" class="btn btn-success">Tambah Fasilitas</button></center>
</form>
