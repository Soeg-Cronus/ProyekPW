<?php 
    require_once("conn.php");

    if (isset($_REQUEST['token'])) {
        $token = $_REQUEST['token'];
        $getuser = $conn->query("select * from user where token = '$token'")->num_rows;
        if ($getuser > 0) {
            $result = $conn->query("update user set email_confirm=1 where token='$token'");
            if ($result) {
                header("Location: ../index.php");
            }
            else {
                echo "Gagal verifikasi!";
            }
        }
        else {
            echo "User not found!";
        }
    }
    else {
        echo "No token provided!";
    }
?>