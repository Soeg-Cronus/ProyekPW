<?php session_start();

  if(isset_REQUEST["btLogin"]){
    header("Location:index.php");
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <link rel="stylesheet" href="asset/css/login.css">
</head>

<body>

  <div class="background">

  </div>
 
  <form action="#" method="get">  
    <h3>Login Here</h3>

    <label for="username">Username</label>
    <input type="text" placeholder="Email or Phone" id="username">

    <label for="password">Password</label>
    <input type="password" placeholder="Password" id="password">

    <input type="submit" value="Login" name="btLogin">
    <div class="social">
      <a href="index.php" style="text-decoration: none"><div class="back">Back</div></a>
      <a href="register.php" style="text-decoration: none"><div class="reg">Register</div></a>
    </div>
  </form>

</body>

</html>