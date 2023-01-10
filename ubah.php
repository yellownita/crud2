<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];


// query data mahasiswa berdasarkan id
$brg = query("SELECT * FROM barang WHERE id_barang = $id")[0];


// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
	}


}

if (isset($_POST["submit"]) ){
 
	
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah data barang</title>
</head>
<body>
	<h1>Ubah data barang</h1>

	<form action="" method="post" enctype="multipart/form-data">


		<input type="hidden" name="id_barang" value="<?= $brg["id_barang"]; ?>">
		<input type="hidden" name="gambarLama" value="<?= $brg["gambar"]; ?>">
		<ul>
		
			<li>
				<label for="nama_barang">nama_barang : </label>
				<input type="text" name="nama_barang" id="nama_barang" value="<?= $brg["nama_barang"]; ?>">
			</li>
			<li>
				<label for="harga">harga :</label>
				<input type="text" name="harga" id="harga" value="<?= $brg["harga"]; ?>">
			</li>
			<li>
				<label for="stok">stok :</label>
				<input type="text" name="stok" id="stok" value="<?= $brg["stok"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar :</label> <br>
				<img src="gambar/<?= $brg['gambar']; ?>" width="40"> <br>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Ubah Data!</button>
			</li>
		</ul>

	</form>




</body>
</html>
