<?php
    $host = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $dbname = "proyekPW";

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