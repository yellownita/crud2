<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
// cek submit
if( isset($_POST["submit"]) ) {
	
	// cek berhasil 
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
		
	}
	else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
			
			</script>
		";
	}


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah data barang</title>
</head>
<body>
	<h1>Tambah data barang</h1>

	<form action="" method="post"  enctype="multipart/form-data">
		<ul>
			
			<li>
				<label for="nama_barang">Nama : </label>
				<input type="text" name="nama_barang" id="nama_barang">
			</li>
			<li>
				<label for="harga">harga :</label>
				<input type="text" name="harga" id="harga">
			</li>
			<li>
				<label for="stok">stok :</label>
				<input type="text" name="stok" id="stok">
			</li>
			<li>
				<label for="gambar">Gambar :</label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambah</button>
			</li>
			<a href="index.php">kembali</a>
		</ul>

	</form>




</body>
</html>