<?php
    $production = false;
    if ($_SERVER['SERVER_NAME'] != 'localhost') {
        $production = true;
    }
    else {
        $production = false;
    }

    if (!$production) {
        $host = "localhost";
        $usernamedb = "root";
        $passworddb = "";
        $dbname = "proyekPW";
    }
    else {
        $host = "localhost";
        $usernamedb = "ahihisto_admin";
        $passworddb = "XD^gs@dVZB6~";
        $dbname = "ahihisto_proyekpw";
    }

    $conn = mysqli_connect($host,$usernamedb,$passworddb,$dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka, 0, ",", ".") . ",-";
        return $hasil_rupiah;
    
    }
    
    function digit($angka){
	
        $hasil_rupiah = number_format($angka, 0, ",", ".") . ",-";
        return $hasil_rupiah;
    
    }
?>