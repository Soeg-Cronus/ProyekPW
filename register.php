<?php session_start();?>
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

    <label for="username">Username</label>
    <input type="text" placeholder="Email or Phone" id="username">

    <label for="datetime">Birth Date</label>
    <input type="date" id="start" name="trip-start" min="1921-01-01" max="2002-12-31">

    <label for="gender">Gender</label>
    <input type="text" placeholder="Pria/Wanita" id="gender">

    <label for="password">Password</label>
    <input type="password" placeholder="Password" id="password">

    <label for="repassword">Confirm Password</label>
    <input type="password" placeholder="Confirm Password" id="repassword">



    <button class="alo">Register</button>
    <div class="social">
      <a href="index.php" style="text-decoration: none"><div class="back">Back</div></a>
      <a href="login.php" style="text-decoration: none"><div class="reg">Login</div></a>
    </div>
  </form>
</div>
</body>

</html>