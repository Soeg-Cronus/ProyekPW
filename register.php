<?php 
  session_start();

  if(isset($_REQUEST["btRegis"])){
    require_once("backend/conn.php");

    $uname1=$_REQUEST["unamelogin"];
    $birth1=$_REQUEST["birthlogin"];
    $gender1=$_REQUEST["genderlogin"];
    $nama1=$_REQUEST["namalogin"];
    $alamat=$_REQUEST["alamatlogin"];
    $pass1=$_REQUEST["pwlogin"];
    $pass2=$_REQUEST["repwlogin"];


    $kueri="insert into user (username,nama,password,jenis_kelamin,alamat)";
    if(mysqli_query($conn,$kueri)){
      echo "Berhasil Register!";
    }
    else{
      echo "Error di mana gaes ahihihi";
    }
    mysqli_close($conn);
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register</title>
  <link rel="stylesheet" href="asset/css/login.css">
</head>

<body>
  <div class="background">

  </div>
<div class="buatform">
  <form method="post" action="">
    <h3>Register Here</h3>

    <label for="name">Nama</label>
    <input type="text" placeholder="Name" id="name" name="namalogin">

    <label for="username">Username</label>
    <input type="text" placeholder="Email or Phone" id="username" name="unamelogin">

    <label for="datetime">Birth Date</label>
    <input type="date" id="start" name="trip-start" min="1921-01-01" max="2002-12-31" name=birthlogin name="birthlogin">

    <label for="gender">Gender</label>
    <input type="text" placeholder="Pria/Wanita" id="gender" name="genderlogin">

    <label for="alamat">alamat</label>
    <input type="text" placeholder="Alamat Rumah" id="alamat" name="alamatlogin">

    <label for="password">Password</label>
    <input type="password" placeholder="Password" id="password" name="pwlogin">

    <label for="repassword">Confirm Password</label>
    <input type="password" placeholder="Confirm Password" id="repassword" name="repwlogin">



   <input type="submit" value="Register" name="btRegis">
    <div class="social">
      <a href="index.php" style="text-decoration: none"><div class="back">Back</div></a>
      <a href="login.php" style="text-decoration: none"><div class="reg">Login</div></a>
    </div>
  </form>
</div>
</body>

</html>