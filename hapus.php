<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

$id = $_GET["id"];

if( hapus($id) > 0 ) {
	echo "
		<script>
			alert('data terhapus');
			document.location.href = 'index.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data tidak bisa terhapus');
			document.location.href = 'index.php';
		</script>
	";
}

?>