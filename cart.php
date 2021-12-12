<?php
    namespace Midtrans;
    require_once("backend/conn.php");
    require_once('backend/Midtrans/examples/snap/credential.php');
    require_once('backend/Midtrans/Midtrans.php');
    session_start();
 
    // function rupiah($angka){

    //     $hasil_rupiah = "Rp " . number_format($angka, 0, ",", ".") . ",-";
    //     return $hasil_rupiah;

    // }
    $datausernow = null;
    $useractive = null;
    if (isset($_SESSION['loggedin'])) {
        $useractive = $_SESSION['loggedin'];
        $datausernow = $conn->query("select * from user where username = '$useractive'")->fetch_assoc();
        if (!$datausernow['email_confirm']) {
            header("Location: verifikasi.php");
        }
    } else {
        header("Location: index.php");
    }

    if (isset($_REQUEST["btPindahLogin"])) {
        header("Location: login.php");
    }
    if (isset($_REQUEST["btPindahRegis"])) {
        header("Location: register.php");
    }
    if (isset($_REQUEST["btnLogout"])) {
        header("Location: backend/logout.php");
    }

    if (isset($_REQUEST["cari"])) {
        header("Location: index.php?" . http_build_query(array('q' => $_REQUEST['q'])));
    }
    
    $protocol = $_SERVER['REQUEST_SCHEME'];
    $servername = $_SERVER['SERVER_NAME'];
    $path = $_SERVER['REQUEST_URI'];
    $remove = basename($path);
    $path = str_replace($remove, '', $path);


    $rakit_url = $protocol . "://" . $servername . $path;
    $linkonly = "backend/Midtrans/examples/checkout-process.php";
    // $linkonly = $rakit_url . "backend/Midtrans/examples/checkout-process.php";
?>



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

    // Set Your server key
    // can find in Merchant Portal -> Settings -> Access keys
    Config::$serverKey = $myserver;
    Config::$clientKey = $myclient;

    // non-relevant function only used for demo/example purpose
    printExampleWarningMessage();

    // Uncomment for production environment
    // Config::$isProduction = true;

    // Enable sanitization
    Config::$isSanitized = true;

    // Enable 3D-Secure
    Config::$is3ds = true;

    // Uncomment for append and override notification URL
    // Config::$appendNotifUrl = "https://example.com";
    // Config::$overrideNotifUrl = "https://example.com";

    // Required

    $transaction_details = array(
        'order_id' => rand(),
        'gross_amount' => 94000, // no decimal allowed for creditcard
    );

    // Fill transaction details
    $transaction = array(
        'transaction_details' => $transaction_details,
    );

    $snap_token = '';
    try {
        $snap_token = Snap::getSnapToken($transaction);
    }
    catch (\Exception $e) {
        echo $e->getMessage();
    }

    echo "snapToken = ".$snap_token;
    //TODO::

    function printExampleWarningMessage() {
        if (strpos(Config::$serverKey, 'your ') != false ) {
            echo "<code>";
            echo "<h4>Please set your server key from sandbox</h4>";
            echo "In file: " . __FILE__;
            echo "<br>";
            echo "<br>";
            echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
            die();
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
    $macamdiskon = $conn->query("select * from diskon group by nama_diskon")->fetch_all(MYSQLI_ASSOC);

    $ada = false;
    $adadiskon = false;

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

    if ($adadiskon) {
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

    $cart = $conn->query("select * from cart where username='$useractive'")->fetch_assoc();
    $newcart = [];
    $jumlahbarang = 0;
    $finalcart = [];
    $total = 0;
    if ($cart != null) {
        $newcart = json_decode($cart['id_barang']);
        $jumlahbarang = count($newcart);
    }
    // echo "<pre>";
    // var_dump($cart);
    // echo "</pre>";

    foreach ($newcart as $key => $value) {
        $value = (array) $value;
        $id = $value['id-barang'];
        $datacart = $conn->query("SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb LEFT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb RIGHT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
        $preview = $datacart + $value;
        $finalcart[] = $preview;
    }
    // echo "<pre>";
    // var_dump($finalcart);
    // echo "</pre>";

    // $sql = "SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb LEFT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = 'AUD0098703' UNION SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb RIGHT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = 'AUD0098703';";

    // echo "<pre>";
    // var_dump($macamjenis);
    // echo "</pre>";

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
                                <li><a class="dropdown-item" href="?<?= http_build_query(array('diskon' => $value['nama_diskon'])) ?>"><?= $value['nama_diskon'] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>

                    <?php
                    if ($datausernow != null) {
                    ?>
                        <form action="" method="post">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?= $datausernow['nama'] ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="wishlist.php">Wishlist</a></li>
                                    <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                                    <li><a class="dropdown-item" href="history.php">History</a></li>
                                    <li><a class="dropdown-item" href="track.php">Track</a></li>
                                </ul>
                            </li>
                        </form>
                    <?php
                    }
                    ?>
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
    <h1 class="display-4 fw-bolder">
        <center>Cart</center>
    </h1>
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div id="jmlbarang0" class="col align-self-center text-right text-muted"><?= ($jumlahbarang != 0)? $jumlahbarang:'' ?> items</div>
                    </div>
                </div>
                <div id="isi">
                    <?php
                    if ($cart == null) :
                        echo 'Keranjang kosong';
                    else:
                    $total = 0;
                    foreach ($finalcart as $key => $value) {
                    ?>
                        <div class="row border-top <?= ($key == count($finalcart) - 1) ? 'border-bottom' : '' ?>">
                            <div class="row main align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="<?= $value['urlgambar'] ?>" alt="<?= str_replace('"', "&quot;", $value['nama_barang']); ?>">
                                </div>
                                <div class="col">
                                    <div class="row text-muted">
                                        <?= $value['jenis_barang'] ?>
                                    </div>
                                    <div class="row">
                                        <?= $value['nama_barang'] ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <input type="number" onchange="changeJumlah('<?= $value['id_barang'] ?>', '<?= $useractive ?>', event)" value="<?= $value['jumlah'] ?>" name="jmlh" min="1" max="100">
                                    <button type="button" onclick="removeBarang('<?= $value['id_barang'] ?>', '<?= $useractive ?>')" style="border: none; border-radius: 5px; background-color: red; color: white; height: 25px; width: 25px; transform: translateY(1.5px);">
                                        &#10005;
                                    </button>
                                </div>
                                <div class="col">
                                    <?= ($value['jumlah_diskon'] == null) ? rupiah($value['harga']) : rupiah($value['harga'] * (1 - $value['jumlah_diskon'])) ?>
                                    <span class="close"> &#10005; </span>
                                    <?= $value['jumlah'] ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        $total += $value['jumlah'] * $value['harga'] * (1 - $value['jumlah_diskon']);
                    }
                    endif;
                    ?>
                </div>

                <!-- <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/pHQ3xT3.jpg"></div>
                        <div class="col">
                            <div class="row text-muted">Shirt</div>
                            <div class="row">Cotton T-shirt</div>
                        </div>
                        <div class="col"> <input type="number" id="jumlah" name="jmlh" min="1" max="100"> </div>
                        <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                    </div>
                </div> -->
                <div class="back-to-shop">
                    <a href="./" style="padding: 4px; text-shadow: none; color: black;">
                        &leftarrow;<span style="text-shadow: none;" class="text-muted">Back to shop</span>
                    </a>
                </div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h3><b>Summary</b></h3>
                </div>
                <hr>
                <div class="row" style="margin-left: 0;">
                    <div id="jmlbarang1" class="col" style="padding-left:0;">ITEMS <?= $jumlahbarang ?></div>
                    <div id="totalharga" class="col text-right"><?= rupiah($total) ?></div>
                </div>
                <form>
                    <!-- yg bikin slh -->
                    <p>SHIPPING</p>
                    <select onchange="changeShip()" id="shipping">
                        <!-- <option value="S1" class="text-muted">Pengiriman Standar - &euro;5.00</option>
                        <option value="S1" class="text-muted">Pengiriman Standar - &euro;5.00</option>
                        <option value="S2" class="text-muted">Pengiriman Kilat - &euro;5.00</option> -->
                    </select>
                    <!-- <p>PROMO CODE</p> <input id="code" placeholder="Enter your code"> -->
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div id="paid" class="col text-right">
                        <!-- paid -->
                        <?= rupiah($total + 20000)?>
                    </div>
                </div>
                <!-- <form action="<?//=$linkonly?>" method="post"> -->
                    <!-- TODO:: -->
                    <button type="submit" id="pay-button" class="btn">CHECKOUT</button>
                <!-- </form> -->
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
    <script src="backend/ajax.js"></script>

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            let delivery = $("#shipping").val();
            $.ajax({
                type: "post",
                url: "backend/ajaxcontroller.php",
                data: {
                    'mode': 'cout',
                    'id': session,
                    'idShipping': delivery
                },
                success: function (response) {
                    snap.pay('<?php echo $snap_token?>');
                }
            });

        };
    </script>

</body>

</html>