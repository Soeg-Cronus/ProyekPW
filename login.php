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
	if (isset($_REQUEST["btLogin"])) {
		require_once("backend/conn.php");

		$namauser = $_REQUEST["uname"];
		$passuser = $_REQUEST["upass"];

		$kueri = $conn->query("SELECT * FROM user")->fetch_all(MYSQLI_ASSOC);

		$booluser = false;
		$boolpass = false;

		// var_dump($_REQUEST["uname"]);
		// var_dump($_REQUEST["upass"]);

		foreach ($kueri as $key => $value) {
			if ($value["username"] == $_REQUEST["uname"]) {
				$booluser = true;
				if ($value["password"] == md5($_REQUEST["upass"])) {
					$boolpass = true;
				}
			}
		}

		if (!$booluser) {
			echo '<script>alert("Username  salah!")</script>';
		} else if (!$boolpass) {
			echo '<script>alert("Password salah!")</script>';
		} else if ($boolpass && $booluser) {
			$_SESSION['loggedin'] = $value['username'];
			header("Location: index.php");
		} else if (!$booluser && !$boolpass) {
			echo '<script>alert("Username dan Password salah!")</script>';
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

</body>

</html>