<?php
session_start();
require_once("backend/conn.php");

if (isset($_REQUEST["btPindahLogin"])) {
    header("Location: login.php");
}
if (isset($_REQUEST["btPindahRegis"])) {
    header("Location: register.php");
}
if (isset($_REQUEST["btnLogout"])) {
    header("Location: backend/logout.php");
}

$datausernow = null;
$useractive = null;

if (isset($_SESSION['loggedin'])) {
    $useractive = $_SESSION['loggedin'];
    $datausernow = $conn->query("select * from user where username = '$useractive'")->fetch_assoc();
    if (!$datausernow['email_confirm']) {
        header("Location: verifikasi.php");
    }
}
else {
    header("Location: index.php");
}
?>
<html lang="en">

<head>
    <base href="index.php">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/css/stylesindex.css">
    <link rel="stylesheet" href="asset/css/histo.css">

    <style>
        /* Popup container - can be anything you want */
        .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* The actual popup */
        .popup .popuptext {
        visibility: hidden;
        width: 50vw;
        background-color: #555;
        color: #fff;
        /* text-align: center; */
        border-radius: 6px;
        padding: 8px 8px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
        /* overflow-y: scroll; */
        transform: translateY(15vh);
        }

        /* Popup arrow */
        /* .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -20vw;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
        } */

        /* Toggle this class - hide and show the popup */
        .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
        from {opacity: 0;} 
        to {opacity: 1;}
        }

        @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
        }

        .containerdetail{
            display: flex;
            flex-direction: column;
            /* align-items: flex-start; */
        }

        .containerdetail .containeritem{
            display: flex;
            justify-content: space-between;
        }

        .containerdetail .nama{
            display: flex;
            width: 78%;
        }
        .containerdetail .harga{
            display: flex;
        }
    </style>

    <title>About</title>
</head>

<body>
    <?php 
        $transaksi = $conn->query("select * from transaksi where username='$useractive'")->fetch_all(MYSQLI_ASSOC);
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand">Ahihi Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="./">Back</a></li>
                </ul>
                <form action="" method="post">
                    <?php
                    if ($datausernow == null) {
                    ?>
                        <div class="wew">
                            <div class="namae back">
                                <input class="namae back" type="submit" value="Login" name="btPindahLogin">
                            </div>
                            <div class="namae reg">
                                <input class="namae back" type="submit" value="Register" name="btPindahRegis">
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="wew">
                            <div class="namae back">
                                <input type="submit" value="Logout" name="btnLogout">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="wrapper">
            <h1> Pucrhase History</h1>

            <ul class="sessions">
                <?php 
                    foreach ($transaksi as $key => $value) {
                        $rawbarang = json_decode($value['id_barang']);
                        $barang = [];
                        foreach ($rawbarang as $i => $val) {
                            $temp = (array) $val;
                            $id = $temp['id-barang'];
                            $detail = $conn->query("SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb LEFT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb RIGHT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
                            array_push($barang, $detail);
                        }
                        $idkirim = $value['id_shipment'];
                        $biayakirim = $conn->query("select * from pengiriman where id_pengiriman='$idkirim'")->fetch_object()->harga;
                        $out = strlen($barang[0]['nama_barang']) > 25 ? substr($barang[0]['nama_barang'],0,25)."..." : $barang[0]['nama_barang'];
                        
                        $transaction = strtolower($value['status']);
                        $stmt = '';
                        if ($transaction == 'capture') {
                            if ($transaction != 'challenge') {
                                $stmt = "Success";
                            }
                            else {
                                $stmt = "Pending";
                            }
                        } else if ($transaction == 'settlement' || $transaction == 'success') {
                            $stmt = "Success";
                        } else if ($transaction == 'pending' || $transaction == '') {
                            $stmt = "Pending";
                        } else {
                            $stmt = "Canceled";
                        }
                ?>
                        <li>
                            <div onclick="myFunction('<?=$key?>')" class="popup time">
                                <div>
                                    <?=(count($barang) > 1)? $out . " <sup>+".(count($barang)-1) . "</sup>" : $out ?> (<?=$stmt?>)
                                </div>
                                <div style="margin-top: 1vh; font-size: 13px;">
                                    <sub><?=date("D, d F Y", strtotime($value['tanggal']))?></sub>
                                </div>
                                <span class="popuptext" id="myPopup-<?=$key?>">
                                    <div class="containerdetail">
                                        <?php 
                                            foreach ($barang as $j => $v) {
                                                $out1 = strlen($v['nama_barang']) > 50 ? substr($v['nama_barang'],0,50)."..." : $v['nama_barang'];
                                        ?>
                                            <!-- A Simple Popup! <br> -->
                                            <div class="containeritem">
                                                <div class="nama">
                                                    <?=$out1?>
                                                </div>
                                                <div class="harga">
                                                    <?=rupiah($v['harga'])?>
                                                </div>
                                            </div>
                                        <?php 
                                            }
                                        ?>
                                        <div class="containeritem">
                                            <div class="nama">
                                                Delivery Fee
                                            </div>
                                            <div class="harga">
                                                <?=rupiah($biayakirim)?>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <p>
                                <?=rupiah($value['grandtotal'])?>
                            </p>
                        </li>
                <?php 
                    }
                ?>
                
                <!-- <li>
                    <div class="time">
                        RX6600 XT dual fan - 05/08/2021
                    </div>
                    <p>
                        999$
                    </p>
                </li>
                <li>
                    <div class="time">
                        RX6600 XT dual fan - 05/08/2021
                    </div>
                    <p>
                        999$
                    </p>
                </li> -->
            </ul>
        </div>
    </div>

    <script>
        // When the user clicks on div, open the popup
        function myFunction(key) {
            var popup = document.getElementById("myPopup-"+key);
            popup.classList.toggle("show");
        }
    </script>

</body>

</html>