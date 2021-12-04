<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="asset/css/login.css">
</head>

<body>

    <?php
        if (isset($_REQUEST["btRegis"])) {
            require_once("backend/conn.php");

            $uname = $_REQUEST["unamelogin"];
            $birth = $_REQUEST["birthlogin"];
            $gender = $_REQUEST["genderlogin"];
            $nama = $_REQUEST["namalogin"];
            $alamat = $_REQUEST["alamatlogin"];
            $pass1 = $_REQUEST["pwlogin"];
            $pass2 = $_REQUEST["repwlogin"];

            if ($uname != "" && $birth != "" && $gender != "" && $nama != "" && $alamat != "" && $pass1 != "" && $pass2 != "") {
                if (date("Y") - date((int)$birth) >= 18) {
                    if ($pass1 == $pass2) {
                        $pass1 = md5($pass1);

                        $stmt = $conn->prepare("select * from user where username=?");
                        $stmt->bind_param("s", $uname);
                        $stmt->execute();
                        $userada = $stmt->get_result()->num_rows;
                        // $userada = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        // echo "<pre>";
                        // var_dump(count($userada));
                        // echo "</pre>";


                        if ($userada > 0) {
                            echo "<script>alert('Email sudah terdaftar!')</script>";
                        }
                        else {
                            $temp = [
                                md5('uname') => urlencode(base64_encode($uname))
                            ];
                            $token = bin2hex(random_bytes(50));
                            $verified = false;
                            $verified = intval($verified);
                            $state = $conn->prepare("insert into user values (?,?,?,?,?,?,?,?)");
                            $state->bind_param("ssssssis", $uname, $nama, $pass1, $birth, $gender, $alamat, $verified, $token);
                            if ($state->execute()) {
                                $temp = http_build_query($temp);
                                header("Location: backend/userauth.php?".$temp);
                            } else {
                                echo "Error!";
                            }                
                        }
                    }
                    else {
                        echo "<script>alert('Password tidak sama!')</script>";
                    }
                }
                else {
                    echo "<script>alert('Umur masih belum cukup!')</script>";
                }
            }
            else {
                echo "<script>alert('Isi semua field!')</script>";
            }

            
            
        }
    ?>

    <div class="background">

    </div>
    <div class="buatform">
        <form method="post" action="">
            <h3>Register Here</h3>

            <label for="name">Nama</label>
            <input type="text" placeholder="Name" id="name" name="namalogin">

            <label for="username">Email or Phone Number</label>
            <input type="text" placeholder="Email or Phone" id="username" name="unamelogin">
            
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name="pwlogin">

            <label for="repassword">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" id="repassword" name="repwlogin">

            <label for="alamat">Alamat</label>
            <input type="text" placeholder="Alamat Rumah" id="alamat" name="alamatlogin">
            
            <label for="datetime">Birth Date</label>
            <input type="date" id="start" name="birthlogin">
            
            <label for="gender">Gender</label>
            <!-- <input type="text" placeholder="Pria/Wanita" id="gender" name="genderlogin"> -->
            <select name="genderlogin" id="gender">
                <option hidden selected value="">Gender</option>
                <option style="color: black;" value="Pria">Pria</option>
                <option style="color: black;" value="Wanita">Wanita</option>
            </select>

            <input type="submit" value="Register" name="btRegis">
            <div class="social">
                <a href="index.php" style="text-decoration: none">
                    <div class="back">Back</div>
                </a>
                <a href="login.php" style="text-decoration: none">
                    <div class="reg">Login</div>
                </a>
            </div>
        </form>
    </div>

</body>

</html>