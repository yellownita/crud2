<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
$barang = query("SELECT * FROM barang");




if( isset($_POST["cari"]) ) {
	$barang = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="./sytle.css">
	<title>Halaman Admin</title>
</head>
<body>


<h1>Daftar barang</h1>


<br><br>

<form action="" method="post">

	<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">

	<button type="submit" name="cari">Cari!</button>
	
</form>

<br>

<table border="1" cellpadding="10" cellspacing="0">

	<tr>
		<th>No.</th>
		<!-- <th>Id Barang </th> -->
		<th>Nama Barang</th>
		<th>harga</th>
		<th>stok</th>
		<th>gambar</th>
		<th>aksi</th>
		<th>last edit by </th>
	</tr>

	<?php $i = 1; ?>
	<?php foreach( $barang as $row ) : ?>
	<tr>
		<td><?= $i; ?></td>
		<!-- <td>></td></td> -->
        <td><?= $row["nama_barang"]; ?></td>
		<td><?= $row["harga"]; ?></td>
		<td><?= $row["stok"]; ?></td>
		<td><img src="gambar/<?= $row["gambar"]; ?>" width="50"></td>
		<td>
			<a href="ubah.php?id=<?= $row["id_barang"]; ?>">ubah</a> |
			<a href="hapus.php?id=<?= $row["id_barang"]; ?>" onclick="return confirm('yakin?');">hapus</a>
		</td>
		<td>  Last Edit By <?= $row["email"]; ?></td>
		
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>

</table>
	
<a href="logout.php">Logout</a>
<a href="tambah.php">Tambah data barang</a>
	

</body>
</html>