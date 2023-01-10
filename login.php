<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}


require 'functions.php';

if( isset($_POST["login"]) ) {

	$email = $_POST["email"];
	$_SESSION['email'] = $email;
	$password = $_POST["password"];


	$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="./sytle.css">
	<title>Halaman Login</title>
</head>
<body>



<?php if( isset($error) ) : ?>

   <script> alert('tolong isi data / email / password salah')  </script>;

<?php endif; ?>

<form action="" method="post">






<!-- hah -->



<!-- <div class="container">
  <div class="brand-logo"></div>
  <div class="brand-title">LOGIN</div> -->
  <form>
  <div class="segment">
    <h1>LOGIN</h1>
  </div>
		
			<label for="email">Email </label>
			<input type="text" name="email" id="email">
		
			<label for="password">Password </label>
			<input type="password" name="password" id="password">
		
			<label for="repassword">Re Password </label>
			<input type="password" name="repassword" id="repassword">
	

		
			<button type="submit" name="login">Login</button>
		

	
            <a href="registrasi.php">Wanna make an account? or u don't have an account?</a>
</form>     

	







</body>
</html>