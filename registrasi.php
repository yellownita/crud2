<?php 
require 'functions.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrasi</title>
	<link rel="stylesheet" href="./sytle.css">
	
</head>
<body>

<form action="" method="post">

	
<form>
  <div class="segment">
    <h1>REGISTER</h1>
</div>	
        <div class="name">
			<label for="name">Name </label>
			<input type="text" name="name" id="name">
		</div>
		<div class="uname">
			<label for="username">Username </label>
			<input type="text" name="username" id="username">
		</div>
		<div class="email">
			<label for="email">Email </label>
			<input type="text" name="email" id="email">
		</div>
		<div class="wa">
			<label for="whatsapp">Whatsapp </label>
			<input type="text" name="whatsapp" id="whatsapp">
		</div>
		<div class="pw">
			<label for="password">Password </label>
			<input type="password" name="password" id="password">
		</div>	
		<div class="rp">
		<label for="repassword">Re password </label>
			<input type="password" name="repassword" id="repassword">
		</div>
			
		


		
			<button type="submit" name="register">Register!</button>
		
        
            <a href="login.php">LOGIN</a>
        
	
	
</form>

</body>
</html>