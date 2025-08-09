<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../../lib/sweet.js"></script>
</head>
<body>

<?php
	include"koneksi.php";
	session_start();
	echo "<script>swal({
  title: 'Yakin Ingin Keluar?',
  type: 'warning',
  backdrop: 'rgb(255, 255, 255)',
  showCancelButton: true,
}).then((result) => {
    if (result.dismiss === swal.DismissReason.cancel) {
  		window.setTimeout(function(){
			window.location.replace('../beranda');
 		} ,100)
 	}
 	else if (result.value) {
    	window.setTimeout(function(){
			window.location.replace('unset');
 		} ,0)
 	}
  	});</script>";

  	
?>