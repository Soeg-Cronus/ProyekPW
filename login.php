<?php 
  session_start(); 
  
  if(isset($_REQUEST["btLogin"])){
    require_once("backend/conn.php");

    $namauser=$_REQUEST["uname"];
    $passuser=$_REQUEST["upass"];

    $kueri="select nama, from user where username='$namauser' and password='$passuser'";

    $lomgin=mysqli_query($conn,$kueri);

    if (mysqli_num_rows($lomgin) > 0){
      while ($baris = mysqli_fetch_assoc($lomgin)){
          $_SESSION["username"] = $baris["nama"];
      }
     
    }
    mysqli_close($conn);

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

  <form action="#" method="post">
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