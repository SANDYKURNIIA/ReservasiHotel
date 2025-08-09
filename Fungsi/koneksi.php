<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$database = "sisfohotel";
	$url = 'mysql:host=localhost;dbname=sisfohotel';
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
	try {
		$pdo = new PDO($url, $user, $pass, $options);
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  		// hapus koneksi
  		$dbh = null;
	}
	catch (PDOException $e) {
	  // tampilkan pesan kesalahan jika koneksi gagal
	  print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
	  die();
	}
?>
