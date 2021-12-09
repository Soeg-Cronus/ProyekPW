<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ahihi Store</title>

    <base href="index.php">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="asset/css/stylesindex.css" rel="stylesheet" />
    <link rel="stylesheet" href="asset/css/cat.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>



<body>

    <?php
    require_once("backend/conn.php");

    // function rupiah($angka){

    //     $hasil_rupiah = "Rp " . number_format($angka, 0, ",", ".") . ",-";
    //     return $hasil_rupiah;

    // }

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


    // echo "<pre>";
    // var_dump($useractive);
    // echo "</pre>";

    $jenis = '';
    if (isset($_REQUEST['jenis'])) {
        $jenis = $_REQUEST['jenis'];
    }

    $diskon = '';
    if (isset($_REQUEST['diskon'])) {
        $diskon = $_REQUEST['diskon'];
    }
    $tampungdata;
    //echo "<script>alert('$diskon')</script>";

    $macamjenis = $conn->query("select * from daftar_jenis")->fetch_all(MYSQLI_ASSOC);
    $macamdiskon= $conn->query("select * from diskon group by nama_diskon")->fetch_all(MYSQLI_ASSOC);

    $ada = false;
    $adadiskon=false;

    foreach ($macamdiskon as $key => $value) {
        if ($value['nama_diskon'] == $diskon) {
            $adadiskon = true;
        }
    }

    foreach ($macamjenis as $key => $value) {
        if ($value['jenis_barang'] == $jenis) {
            $ada = true;
        }
    }
    // echo "<pre>";
    // var_dump($ada);
    // echo "</pre>";

    if ($ada) {
        $state = $conn->prepare("select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb left JOIN diskon d on d.id_barang = mb.id_barang where mb.id_jenis_barang = (select id_jenis from daftar_jenis where jenis_barang = ?) UNION select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb right join diskon d on d.id_barang = mb.id_barang where mb.id_jenis_barang = (select id_jenis from daftar_jenis where jenis_barang = ?)");
        $state->bind_param("ss", $jenis, $jenis);
        if ($state->execute()) {
            $tampungdata = $state->get_result()->fetch_all(MYSQLI_ASSOC);
            // echo "<pre>";
            // var_dump($tampungdata);
            // echo "</pre>";
        }
    } else {
        $sql = "select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb left JOIN diskon d on d.id_barang = mb.id_barang UNION select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb right join diskon d on d.id_barang = mb.id_barang";
        $tampungdata = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    if($adadiskon){
        $state = $conn->prepare("select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb left JOIN diskon d on d.id_barang = mb.id_barang where d.nama_diskon = ? UNION select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb right join diskon d on d.id_barang = mb.id_barang where d.nama_diskon = ?");
        $state->bind_param("ss", $diskon, $diskon);
        if ($state->execute()) {
            $tampungdata = $state->get_result()->fetch_all(MYSQLI_ASSOC);
            // echo "<pre>";
            // var_dump($tampungdata);
            // echo "</pre>";
        }
    }
    

    // echo "<pre>";
    // var_dump($tampungdata);
    // echo "</pre>";


    //search
    // $sql = "select mb.*, jb.jenis_barang from master_barang mb JOIN daftar_jenis jb on mb.id_jenis_barang = jb.id_jenis";
    // $stmt = $conn->prepare($sql);
    // // $stmt = $conn->prepare("SELECT * FROM master_barang");
    // $stmt->execute();
    // $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    if (isset($_REQUEST["cari"])) {
        header("Location: index.php?". http_build_query(array('q'=> $_REQUEST['q'])));
    }
    
    if (isset($_REQUEST['q'])) {
        // $sql = "select mb.*, jb.jenis_barang from master_barang mb JOIN daftar_jenis jb on mb.id_jenis_barang = jb.id_jenis where nama_barang like ?";
        $sql = "select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb left JOIN diskon d on d.id_barang = mb.id_barang where mb.nama_barang like ? UNION select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb right join diskon d on d.id_barang = mb.id_barang where mb.nama_barang like ?";
        $stmt = $conn->prepare($sql);
        // $stmt = $conn->prepare("SELECT * FROM master_barang WHERE nama_barang like ?");
        $keyword = "%" . $_REQUEST["q"] . "%";
        $stmt->bind_param("ss", $keyword, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        $tampungdata = $result->fetch_all(MYSQLI_ASSOC);
    }

    //TODO: biar ga bisa ditembak url


    ?>

    <!-- <form action="" method="get"> -->
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a href="./" class="navbar-brand">Ahihi Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?jenis=Monitor">Monitor</a></li>
                                <li><a class="dropdown-item" href="?jenis=Mouse">Mouse</a></li>
                                <li><a class="dropdown-item" href="?jenis=Mouse%20Pad">MousePad</a></li>
                                <li><a class="dropdown-item" href="?jenis=Audio">Audio</a></li>
                                <li><a class="dropdown-item" href="?jenis=Keyboard">Keyboard</a></li>
                                <li><a class="dropdown-item" href="?jenis=PC">PC</a></li>
                                <li><a class="dropdown-item" href="?jenis=Motherboard">Motherboard</a></li>
                                <li><a class="dropdown-item" href="?jenis=Storage">Storage</a></li>
                                <li><a class="dropdown-item" href="?jenis=RAM">Ram</a></li>
                                <li><a class="dropdown-item" href="?jenis=Processor">Processor</a></li>
                                <li><a class="dropdown-item" href="?jenis=VGA">VGA</a></li>
                                <li><a class="dropdown-item" href="?jenis=PSU">PSU</a></li>
                                <li><a class="dropdown-item" href="?jenis=Cooler">Cooler</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Diskon</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                foreach ($macamdiskon as $key => $value) {
                            ?>
                                    <li><a class="dropdown-item" href="?<?=http_build_query(array('diskon'=>$value['nama_diskon']))?>"><?=$value['nama_diskon']?></a></li>
                            <?php
                                }
                            ?>            
                            </ul>
                        </li>
                        
                        <form action="" method="post">
                            <?php 
                            if($datausernow==null){
                            ?>
                            
                            <?php
                            }
                            else{
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?=$datausernow['nama']?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="wishlist.php">Wishlist</a></li>
                                    <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                    <li><a class="dropdown-item" href="history.php">History</a></li>
                                    <li><a class="dropdown-item" href="track.php">Track</a></li>
                                </ul>
                            </li>
                            <?php
                            }
                            ?>
                        </form>
                    </ul>
                </div>
            </div>
            <form action="" method="post">
                <div class="search_box">
                    <!-- <div class="search_btn"> -->
                        <button type="submit" class="search_btn" name="cari" style="border: none; ">
                            <i class="fas fa-search"></i>
                        </button>
                    <!-- </div> -->
                    <input type="text" class="input_search" placeholder="Search" name="q">
                </div>
            </form>
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
                    }
                    else {
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
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Ahihi Store</h1>
                </div>
            </div>


        </header>
        <!-- Section-->
        <h1 class="display-4 fw-bolder"> <center>Cart</center> </h1>
        <div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">3 items</div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/1GrakTl.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"> <input type="number" id="jumlah" name="jmlh" min="1" max="99"> </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="row">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/ba3tvGm.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"> <input type="number" id="jumlah" name="jmlh" min="1" max="99"> </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/pHQ3xT3.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"> <input type="number" id="jumlah" name="jmlh" min="1" max="99"> </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="back-to-shop"><a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS 3</div>
                <div class="col text-right">&euro; 132.00</div>
            </div>
             <form> <!-- yg bikin slh -->
                <p>SHIPPING</p> <select>
                    <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                </select>
                <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">&euro; 137.00</div>
            </div> <button class="btn">CHECKOUT</button>
        </div>
    </div>
</div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
            </div>
        </footer>
    <!-- </form> -->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="asset/js/scripts.js"></script>


</body>

</html>
