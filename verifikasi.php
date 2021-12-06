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
        // echo "<pre>";
        // var_dump($datausernow);
        // echo "</pre>";
        if (isset($datausernow)) {
            if ($datausernow['email_confirm']) {
                header("Location: index.php");
            }
        }
    } else {
        header("Location: index.php");
    }


    if (isset($_REQUEST["btnLogout"])) {
        header("Location: backend/logout.php");
    }

    $macamdiskon = $conn->query("select * from diskon group by nama_diskon")->fetch_all(MYSQLI_ASSOC);
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
                </ul>
            </div>
        </div>
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
            } else {
            ?>
                <div class="wew">
                    <div class="namae" style="border: none; box-shadow: none; cursor: default;">
                        <?= $datausernow['nama'] ?>
                    </div>
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
    <div>
        <h1 class="display-4 fw-bolder">
            <center> Verification</center>
        </h1>
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <center>
                <div class="row gx-3 gx-lg-4 row-cols-2 row-cols-md-4 row-cols-xl-4 justify-content-center" style="color: white;
  text-shadow: 0 0 0.05em #fff, 0 0 0.2em #2fd5ff, 0 0 0.3em #020daf; font-size: 20px; width: 600px;">
                    <center>
                        Dear Customer,
                    </center>
                    <br>
                    Your account haven't been verificated yet, please consider to do the verification process by clicking the button below
                    <!-- tombol verifikasi yang harus ditembak ntah kemana :D -->
                    <div class="wew">
                        <center>
                            <br>
                            <?php 
                                $temp = [
                                    md5('uname') => urlencode(base64_encode($useractive))
                                ];
                                $temp = http_build_query($temp);
                            ?>
                            <form action="backend/userauth.php?<?=$temp?>" method="post">
                                <button style="border: none; background-color: transparent; padding: 0;" name="resend" type="submit">
                                    <div class="back" style="width: 200px">Resend Email</div>
                                </button>
                            </form>
                        </center>
                    </div>

                </div>
            </center>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-danger">Copyright &copy; Your Website 2021</p>
        </div>
    </footer>
    <!-- </form> -->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="asset/js/scripts.js"></script>
</body>

</html>