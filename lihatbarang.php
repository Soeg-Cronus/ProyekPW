<?php session_start();

if (isset($_REQUEST["btPindahLogin"])) {
    header("Location:login.php");
}
if (isset($_REQUEST["btPindahRegis"])) {
    header("Location:register.php");
}



?>


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
    <link rel="stylesheet" href="asset/css/lihatbarang.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <?php
    require_once("backend/conn.php");
    
    $datausernow = null;
    $useractive = null;
    if (isset($_SESSION['loggedin'])) {
        $useractive = $_SESSION['loggedin'];
        $datausernow = $conn->query("select * from user where username = '$useractive'")->fetch_assoc();
        if (!$datausernow['email_confirm']) {
            header("Location: verifikasi.php");
        }
    }


    if (isset($_REQUEST["btnLogout"])) {
        header("Location: backend/logout.php");
    }

    // $sql = "select mb.*, jb.jenis_barang from master_barang mb JOIN daftar_jenis jb on mb.id_jenis_barang = jb.id_jenis where mb.id_barang = ?";
    // $sql = "select mb.*, jb.jenis_barang, d.nama_diskon, d.jumlah_diskon from master_barang mb JOIN daftar_jenis jb on mb.id_jenis_barang = jb.id_jenis join diskon d on d.id_barang = mb.id_barang where mb.id_barang = ?";
    // $sql = "select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb left JOIN diskon d on d.id_barang = mb.id_barang where mb.nama_barang like ? UNION select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb right join diskon d on d.id_barang = mb.id_barang where mb.nama_barang like ?";
    $sql = "select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb left JOIN diskon d on d.id_barang = mb.id_barang where mb.id_barang = ? UNION select mb.*, d.nama_diskon, d.jumlah_diskon from master_barang mb right join diskon d on d.id_barang = mb.id_barang where mb.id_barang = ?;";
    $stmt = $conn->prepare($sql);
    // $stmt = $conn->prepare("SELECT * FROM master_barang WHERE nama_barang like ?");
    $keyword = $_REQUEST["id"];
    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = $result->fetch_assoc();


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
    // echo "<pre>";
    // var_dump($items);
    // echo "</pre>";
    //   echo "<pre>";
    // var_dump($_SESSION['loggedin']);
    // echo "</pre>";
    ?>

    <!-- <form action="" method="post"> -->
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a href="./" class="navbar-brand">Ahihi Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Exit</a></li>
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
                    </ul>
                    <form action="" method="get">
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
                                    <div class="namae back"><input type="submit" value="Login" name="btPindahLogin"></div>
                                    <div class="namae reg"><input type="submit" value="Register" name="btPindahRegis"></div>
                                </div>
                        <?php 
                            }
                            else {
                        ?>
                                <div class="wew">
                                    <div class="namae" style="border: none; box-shadow: none; cursor: default;">
                                        <?=$datausernow['nama']?>
                                    </div>
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
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Ahihi Store</h1>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="product">
            <div class="product__photo">
                <div class="photo-container">
                    <div class="photo-main">
                        <div class="controls">
                        <button <?=($useractive!=null)?'':'hidden'?> type="button" name="cari" style="border: 0; background: transparent" id="tambahwish" onclick="wishlist('<?=$keyword?>','<?=$useractive?>')">
                        Add To Wishlist
                        </button> 
                            Stock:<?= $items['stok'] ?>
                        </div>
                        <img src="<?= $items['urlgambar'] ?>" alt="<?= $items['nama_barang'] ?>">
                    </div>

                </div>
            </div>

            <div class="product__info">
                <div class="title">
                    <h1><?= $items['nama_barang'] ?></h1>
                    <!-- <span>COD: 45999</span> -->
                </div>
                <div class="price">
                    <s><?= ($items['jumlah_diskon'] == null) ? '' : digit($items['harga']) ?></s><br>
                    <strong>Rp. <?= ($items['jumlah_diskon'] == null) ? digit($items['harga']) : digit($items['harga'] * (1 - $items['jumlah_diskon'])) ?></strong>
                    <!-- Rp. <span><?//= digit($items['harga']) ?></span> -->
                </div>

                <div class="description">
                    <h3>Description</h3>
                    <ul>
                        <?php
                        foreach (json_decode($items['deskripsi']) as $key => $value) {
                        ?>
                            <li><?= $value ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <button class="buy--btn">ADD TO CART</button>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="asset/js/scripts.js"></script>
        <script src="backend/ajax.js"></script>
    <!-- </form> -->
</body>

</html>


<!-- <div class="col mb-5">
    <div class="card h-100">
         Product image
        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
         Product details
        <div class="card-body p-4">
            <div class="text-center">
                 Product name
                <h5 class="fw-bolder">Popular Item</h5>
                 Product reviews
                <div class="d-flex justify-content-center small text-warning mb-2">
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                </div>
                 Product price
                $40.00
            </div>
        </div>
         Product actions
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
        </div>
    </div>
</div> -->