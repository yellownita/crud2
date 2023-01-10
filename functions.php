<?php

// koneksi
$conn = mysqli_connect("localhost", "root", "", "sembako");

//qry
function query($query) {
	global $conn ;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah ($data){
	global $conn;
	$nama_barang =  htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars($data["harga"]);
	$stok =  htmlspecialchars($data["stok"]);

	
	// upload gambar
	$gambar = upload();
	if( !$gambar ){
		return false;
	}

	//memasukan data ke data base
	$query = "INSERT INTO `barang`
			 VALUES 
			 (NULL,NULL,'$nama_barang','$harga','$stok', '$gambar')
			 ";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}




	function upload() {
		global $verfi;
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];
		// di upload atau tidak
		if ( $error === 4 ){
			echo"
				<script>
					alert('Gambar Tidak Bole Kosong');
				</script>
			";
			return false;
		}
		
		//hanya boleh upload gambar
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		
		$ekstensiGambar = explode('.', $namaFile);
		
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		
		if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
			echo "<script>
					alert('yang anda upload bukan gambar!');
					document.location.href = 'tambah.php';
				  </script>";
			exit();
			return false;
		}
		//jika ukuran gambar terlalubesar 
		else if( $ukuranFile > 1000000 ) {
			echo "<script>
					alert('ukuran gambar terlalu besar!');
				  </script>";
			return false;
			exit();
		} else {
			//lolos pengecekan gambar lolos di upload 
			// generate nama gambar baru 
			$namaFileBaru = uniqid();
			$namaFileBaru .= '.';
			$namaFileBaru .= $ekstensiGambar;
			move_uploaded_file($tmpName, 'gambar/' . $namaFileBaru);
			return $namaFileBaru;
		}
	}





function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");
	return mysqli_affected_rows($conn);
}


function ubah($data) {
	global $conn;

	$id = $data["id_barang"];

	$email =  $_SESSION['email'];
	
	
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$harga = htmlspecialchars($data["harga"]);
	$stok = htmlspecialchars($data["stok"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);
	
	
	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}
	
	// le

	
	// le

	$query = "UPDATE barang SET
			
			email = '$email',
				nama_barang = '$nama_barang',
				harga = '$harga',
				stok = '$stok',
				gambar = '$gambar'
			  WHERE id_barang = '$id'
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	



	
}


function cari($keyword) {
	$query = "SELECT * FROM barang
				WHERE
				
			  nama_barang LIKE '%$keyword%' OR
			  harga LIKE '%$keyword%' OR
			  stok LIKE '%$keyword%' OR
			  gambar LIKE '%$keyword%'
			";
	return query($query);
}
//  index untuk last editny













// function mencari($keyword) {
// 	$query = "SELECT * FROM user
// 				WHERE
				
// 			  id_user LIKE '%$keyword%' OR
// 			  username LIKE '%$keyword%' OR
// 			  email LIKE '%$keyword%' OR
// 			  whatsapp  LIKE '%$keyword%'

// 			";

// 	return query($query);
// }



function registrasi($data) {
	global $conn;
    
	$name = strtolower(stripslashes($data["name"]));
	$username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $whatsapp = strtolower(stripslashes($data["whatsapp"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$repassword = mysqli_real_escape_string($conn, $data["repassword"]);

	// cek username
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!/ mohon daftar dengan benar')
		      </script>";
		return false;
	}


	//konfirmasi password
	if( $password !== $repassword ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	//  userbaru 
	mysqli_query($conn, "INSERT INTO user VALUES('','$name', '$username', '$email', '$whatsapp', '$password')");

	return mysqli_affected_rows($conn);

}









?>