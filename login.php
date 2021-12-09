<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<link rel="stylesheet" href="asset/css/login.css">
</head>

<body>

	<?php
	echo "<pre>";
	var_dump($_COOKIE);
	echo "</pre>";
	if (isset($_REQUEST["btLogin"])) {
		require_once("backend/conn.php");

		$namauser = $_REQUEST["uname"];
		$passuser = $_REQUEST["upass"];

		$encpass = md5($passuser);

		$result = $conn->prepare("select * from user where username=? and password=?");
		$result->bind_param("ss", $namauser, $encpass);
		if ($result->execute()) {
			$usernow = $result->get_result()->fetch_assoc();
			if ($usernow != null) {
				$_SESSION['loggedin'] = $usernow['username'];
				if ($_COOKIE['cart'] == true) {
					$idbarang = $_COOKIE['idnow'];
					unset($_COOKIE['idnow']);
					unset($_COOKIE['cart']);
					setcookie('idnow', null, -1, '/'); 
					setcookie('cart', null, -1, '/'); 
					header("Location: lihatbarang.php?id=$idbarang");
				}
				else {
					header("Location: index.php");
				}
			}
			else {
				echo '<script>alert("Username dan Password salah!")</script>';
			}
		}
		else {
			echo '<script>alert("Gagal execute!")</script>';
		}
	}
	?>
	<div class="background">

	</div>

	<form action="" method="post">
		<h3>Login Here</h3>

		<label for="username">Username</label>
		<input type="text" placeholder="Email or Phone" id="username" name="uname">

		<label for="password">Password</label>
		<input type="password" placeholder="Password" id="password" name="upass">
		<!--ahihihi-->
		<input type="submit" value="Login" name="btLogin">
		<div class="social">
			<a href="index.php" style="text-decoration: none">
				<div class="back">Back</div>
			</a>
			<a href="register.php" style="text-decoration: none">
				<div class="reg">Register</div>
			</a>
		</div>
	</form>

	<script>
		if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
	</script>

</body>

</html>