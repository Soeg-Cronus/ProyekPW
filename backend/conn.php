<?php
    $host = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $dbname = "proyekPW";

    $conn = mysqli_connect($host,$usernamedb,$passworddb,$dbname);

    if (!$koneksi) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>