<?php
	session_start();
	require_once "../fungsi/koneksi.php";

	if(!isset($_SESSION['user'])){
		//unset($_SESSION['user']);
		//echo "<script>window.location.replace('../fungsi/load.php')</script>";
?>
		<html>
		<head>
		<title></title>
		<script type="text/javascript" src="../lib/sweet.js"></script>
		
		</head>
		<body>
			<script>
				swal({
			  		title: 'Oops...?',
			  		text: 'Silahkan Login Terlebih Dahulu!',
			  		showConfirmButton: false,
			  		type: 'warning',
			  		backdrop: 'rgb(255, 255, 255)',
				});
				window.setTimeout(function(){
					window.location.replace('../');
		 		} ,2000); 
		 	</script>;
		</body>
		</html>
<?php
	}		

		$ambil = $_SESSION['user'];
		$sql = $pdo->query("SELECT * FROM tamu WHERE idtamu='$ambil'");
		$data = $sql->fetch();
		$id = $data['idtamu'];
		$username = $data['username'];
		$email = $data['email'];
		$alamat = $data['alamat'];
		$telepon = $data['telepon'];
		$password = $data['password'];
		$nama = $data['nama'];

		$bts = 22;
		$nmak = strlen($nama);
		if($nmak > $bts) {
			$nm = substr($nama, 0, $bts) . '...';
		}
		else {
			$nm = $nama;
		}
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styling.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="lib/sweet.js"></script>
    <style type="text/css"></style>
    <title>Dashboard User</title>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="profil.php">
      <center>
        <!-- Menampilkan gambar profil yang diambil dari database -->
        <img src="../Gambar/logo.png" 
             alt="Foto Profil" 
             style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
      </center>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-3 mb-lg-0 mx-auto p-2 grid gap-4 ">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="kamar.php">Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="fasilitas.php">Fasilitas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="datapesanan.php">Data Reservasi</a>
        </li>
      </ul>

      <!-- Dropdown User Icon -->
      <div class="dropdown">
        <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user"></i> Profile
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="profil.php">Lihat Profil</a></li>
          <li><a class="dropdown-item" href="../fungsi/proseskeluar.php">Log Out</a></li>
        </ul>
      </div>

    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>