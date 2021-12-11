<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/external/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cssoverview.css">

    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/sidebars.css" rel="stylesheet">
</head>
<body>
    <?php 
        require_once("../backend/conn.php");
        $idactive = '';
        $unameactive = '';
        if (!isset($_SESSION['now'])) {
            header("Location: login.php");
        }
        else {
            $idactive = $_SESSION['now'][0];
            $unameactive = $_SESSION['now'][1];
        }

    if(isset($_REQUEST['btnAddAdmin'])){
        $namabarang=$_REQUEST['itemname'];
        $url=$_REQUEST['urlgambar'];
        $jumlah=$_REQUEST['stock'];
        $desc=$_REQUEST['deskripsi'];

            if($namabrang !=''){
                if($url !=''){
                    if($namabarang !=''){
                        if($jumlah >0){
                            $state = $conn->prepare("insert into master_barang (nama_barang, stok, deskripsi, urlgambar) values (?, ?, ?, ?)");
                            $state->bind_param("siss", $namabarang, $jumlah, $desc, $url);
                            if($state->execute()) {
                                echo "<script>alert('Berhasil Tambah Barang!')</script>";
                            }
                            else{
                                echo "<script>alert('Gagal Tambah Barang!')</script>";
                            }
                        }
                        else {
                            echo "<script>alert('STok harus lebih dari 0!')</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Isi Nama Barang!!')</script>";
                    }
                }
                else {
                    echo "<script>alert('Isi gambar url!')</script>";
                }
            }
            else{
                echo "<script>alert('Isi Nama Barang!')</script>";
            }
    }

    ?>

    <main>
        <div id="sidenav" class="flex-shrink-0 p-3 text-white" style="width: 280px;">
            <a href="/" class="d-flex align-items-center isDisabled title-disabled pb-3 mb-3 link-dark text-decoration-none border-bottom justify-content-between">
                <span class="fs-5 fw-semibold" style="color: #1ad3be">Welcome, <?=$idactive?>!</span>
            </a>
            <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Home
                </button>
                <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Overview</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Reports</a></li>
                    <li><a href="additem.php" class="link-dark isActive rounded" style="color: #1ad3be">Add Item</a><i class="arrow left"></i></li>
                </ul>
                </div>
            </li>
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Orders
                </button>
                <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">New</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Processed</a></li>
                    <li><a href="#" class="link-dark rounded" style="color: #1ad3be">Shipped</a></li>
                </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                </button>
                <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="../admin/addaccount.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">Add Admin</a></li>
                    <li><a href="../admin/listaccount.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">List Admin</a></li>
                    <li><a href="../admin/setting.php" class="link-dark rounded" style="color: #1ad3be">Settings</a></li>
                    <li><a href="../admin/logout.php" class="link-dark rounded" style="color: #1ad3be">Sign out</a></li>
                </ul>
                </div>
            </li>
            </ul>
        </div>
        <div class="b-example-divider"></div>
        <div class="isi">
            <form class="clean container-form d-flex flex-column" action="" method="post">
                <div class="judul">
                    <h1>Add New Item</h1>
                </div>
                <div class="formcontainer">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="urlgambar" >
                        <label for="floatingNama">URL Gambar</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingUsername" name="itemname" >
                        <label for="floatingUsername">Nama Item</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" value="1" name="jmlh" min="1" max="9999" class="form-control" name="stock" >
                        <label for="floatingUsername">Stock</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingUsername" name="deskripsi">
                        <label for="floatingPassword">Deskripsi</label>
                    </div>
                    <div class="submitcontainer">
                        <input class="btn btn-primary" name="btnAddItem" type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>

    </main>
    <script src="js/external/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>



    </body>
</html>