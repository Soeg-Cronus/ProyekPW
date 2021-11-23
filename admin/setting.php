<?php session_start();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/external/bootstrap.min.css" rel="stylesheet">
    <script src="js/external/jquery-3.6.0.js"></script>
    
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
    <link rel="stylesheet" href="css/styleadd.css">
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
            if ($_SESSION['now'][1] != 'owner') {
                header("Location: ../admin/index.php");
            }
            else {
                $idactive = $_SESSION['now'][0];
                $unameactive = $_SESSION['now'][1];
            }
        }

        if (isset($_REQUEST['btnAddAdmin'])) {
            $nama = $_REQUEST['nama'];
            $uname = $_REQUEST['username'];
            $pass = $_REQUEST['password'];
            $hashed = md5($pass);

            if ($nama != "") {
                if ($uname != "") {
                    if ($pass != "") {
                        $state = $conn->prepare("insert into admin (username, password, nama) values (?, ?, ?)");
                        $state->bind_param("sss", $uname, $hashed, $nama);
                        if ($state->execute()) {
                            echo "<script>alert('Berhasil tambah admin!')</script>";
                            // header("Location: ../admin/addaccount.php");
                        }
                        else {
                            echo "<script>alert('Gagal tambah admin!')</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Password harus diisi!')</script>";
                    }
                }
                else echo "<script>alert('Username harus diisi!')</script>";
            }
            else echo "<script>alert('Nama harus diisi!')</script>";
            
        }
    ?>
    <main class="fluid-container">
        <div id="sidenav" class="flex-shrink-0 sidebar p-3 text-white" style="width: 13vw;">
            <a href="" class="d-flex align-items-center isDisabled title-disabled pb-3 mb-3 link-dark text-decoration-none border-bottom justify-content-between">
                <span class="fs-5 fw-semibold">Welcome, <?=$idactive?>!</span>
            </a>
            <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                    Home
                </button>
                <div class="collapse" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="../admin/index.php" class="link-dark rounded">Overview</a></li>
                    <li><a href="#" class="link-dark rounded">Updates</a></li>
                    <li><a href="#" class="link-dark rounded">Reports</a></li>
                    <li><a href="#" class="link-dark rounded">Chats</a></li>
                </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    Dashboard
                </button>
                <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded">Overview</a></li>
                    <li><a href="#" class="link-dark rounded">Weekly</a></li>
                    <li><a href="#" class="link-dark rounded">Monthly</a></li>
                    <li><a href="#" class="link-dark rounded">Annually</a></li>
                </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Orders
                </button>
                <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="link-dark rounded">New</a></li>
                    <li><a href="#" class="link-dark rounded">Processed</a></li>
                    <li><a href="#" class="link-dark rounded">Shipped</a></li>
                </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>
            <li class="mb-1">
                <button class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="true">
                    Account
                </button>
                <div class="collapse show" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="../admin/addaccount.php" class="link-dark rounded">Add New Admin</a></li>
                    <li><a href="../admin/listaccount.php" class="link-dark rounded">List Admin</a></li>
                    <li><a href="../admin/setting.php" class="link-dark isActive rounded">Settings</a><i class="arrow left"></i></li>
                    <li><a href="../admin/logout.php" class="link-dark rounded">Sign out</a></li>
                </ul>
                </div>
            </li>
            </ul>
        </div>
        <div class="b-example-divider"></div>
        <div class="isi">
            <form class="clean container-form d-flex flex-column" action="" method="post">
                <div class="judul">
                    <h1>Settings</h1>
                </div>
                <div class="formcontainer">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="nama" placeholder="Nama">
                        <label for="floatingNama">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Username">
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="submitcontainer">
                        <input class="btn btn-primary" name="btnAddAdmin" type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="js/external/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>
