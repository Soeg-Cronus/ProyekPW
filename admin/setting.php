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
    <link rel="stylesheet" href="css/stylesetting.css">
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

        if (isset($_REQUEST['btnEdit'])) {
            $nama = $_REQUEST['nama'];
            $email = $_REQUEST['email'];
            $hp = $_REQUEST['phone'];
            $newpass = $_REQUEST['password'];

            $tgl = $_REQUEST['tgl'];
            $bulan = $_REQUEST['bln'];
            $tahun = $_REQUEST['thn'];
            $fulltanggal = $tahun . '-' . $bulan . '-' . $tgl;

            $jk = $_REQUEST['jeniskelamin'];
            $file = $_FILES['foto'];

            // echo "<pre>";
            // echo $nama . '<br>';
            // echo $uname . '<br>';
            // echo $email . '<br>';
            // echo $hp . '<br>';
            // echo $newpass . '<br>';
            // echo $fulltanggal . '<br>';
            // echo $jk . '<br>';
            // echo "</pre>";

            if ($file['name'] != '') {
                $target_dir = "../asset/image/profile/";
                
                // echo $file['name']. '<br>';
                // echo $file['tmp_name']. '<br>';
                // echo $file['size']. '<br>';
                // echo $file['type']. '<br>';
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    
                $file_name = $target_dir . $unameactive .".". $ext;
                $asal = $file['tmp_name'];
    
                move_uploaded_file($asal,$file_name);
    
                if ($newpass == "") {
                    $state = $conn->prepare("update admin set nama=?, email=?, hp=?, tgl_lahir=?, jenis_kelamin=?, url=? where username=?");
                    $state->bind_param("sssssss", $nama, $email, $hp, $fulltanggal, $jk, $file_name, $unameactive);
                    if ($state->execute()) {
                        echo "<script>alert('Berhasil update!')</script>";
                    }
                }
                else {
                    $newpass = md5($newpass);
                    $state = $conn->prepare("update admin set password=?, nama=?, email=?, hp=?, tgl_lahir=?, jenis_kelamin=?, url=? where username=?");
                    $state->bind_param("ssssssss", $newpass, $nama, $email, $hp, $fulltanggal, $jk, $file_name, $unameactive);
                    if ($state->execute()) {
                        echo "<script>alert('Berhasil update!')</script>";
                    }
                }
            }
            else {
                if ($newpass == "") {
                    $state = $conn->prepare("update admin set nama=?, email=?, hp=?, tgl_lahir=?, jenis_kelamin=? where username=?");
                    $state->bind_param("ssssss", $nama, $email, $hp, $fulltanggal, $jk, $unameactive);
                    if ($state->execute()) {
                        echo "<script>alert('Berhasil update!')</script>";
                    }
                }
                else {
                    $newpass = md5($newpass);
                    $state = $conn->prepare("update admin set password=?, nama=?, email=?, hp=?, tgl_lahir=?, jenis_kelamin=? where username=?");
                    $state->bind_param("sssssss", $newpass, $nama, $email, $hp, $fulltanggal, $jk, $unameactive);
                    if ($state->execute()) {
                        echo "<script>alert('Berhasil update!')</script>";
                    }
                }
            }
            // echo "<pre>";
            // var_dump($conn->error_list);
            // echo "</pre>";
        }

        $data = $conn->query("select * from admin where username='$idactive'")->fetch_assoc();

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
                    <li><a href="#" class="link-dark rounded">Reports</a></li>
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
                    <li><a href="../admin/addaccount.php" class="link-dark rounded">Add Admin</a></li>
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
            <form class="clean container-form d-flex flex-column" action="" method="post" enctype="multipart/form-data">
                <div class="judul">
                    <h1>Settings</h1>
                </div>
                <div class="formcontainer">
                    <div class="profile-pic mb-3">
                        <label class="-label" for="file">
                            <!-- <span class="glyphicon glyphicon-camera"></span> -->
                            <span>Change Image</span>
                        </label>
                        <input id="file" type="file" name="foto" onchange="loadFile(event)"/>
                        <img src="<?=$data['url']?>" id="output" width="200" />
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="nama" value="<?=$data['nama']?>" placeholder="Nama">
                        <label for="floatingNama">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingUsername" name="username" readonly value="<?=$data['username']?>" placeholder="Username">
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingEmail" name="email" value="<?=$data['email']?>" placeholder="Email">
                        <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPhone" name="phone" value="<?=$data['hp']?>" placeholder="Phone">
                        <label for="floatingPhone">Phone Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="New Password">
                        <label for="floatingPassword">New Password</label>
                    </div>
                    <div class="label">
                        Tanggal lahir
                    </div>
                    <div class="d-flex full mb-3 gap-2">
                        
                        <div class="form-floating">
                            <select class="form-select" id="day" name="tgl" aria-label="Floating label select example">
                                <!-- <option selected value="">Open this select menu</option> -->
                                <?php 
                                    for ($i=1; $i <= 31; $i++) { 
                                ?>
                                    <option <?=(date("d",strtotime($data['tgl_lahir']) ) == $i)?"selected":""?> value="<?=$i?>"><?=$i?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                            <label for="day">Day</label>
                        </div>
                        <div class="form-floating">
                            <select style="width: 8.5vw;" class="form-select" name="bln" id="month" aria-label="Floating label select example">
                                <!-- <option selected value="">Open this select menu</option> -->
                                <?php 
                                    $month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                                    for ($i=0; $i < count($month); $i++) { 
                                ?>
                                    <option <?=(date("F",strtotime($data['tgl_lahir']) ) == $month[$i])?"selected":""?> value="<?=$i+1?>"><?=$month[$i]?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                            <label for="month">Month</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="year" name="thn" aria-label="Floating label select example">
                                <!-- <option selected value="">Open this select menu</option> -->
                                <?php 
                                    $thisyear = (int)date("Y");
                                    for ($i= $thisyear; $i >= $thisyear - 100 ; $i--) { 
                                ?>
                                    <option <?=(date("Y",strtotime($data['tgl_lahir']) ) == $i)?"selected":""?> value="<?=$i?>"><?=$i?></option>
                                <?php 
                                    }
                                ?>
                                
                            </select>
                            <label for="year">Year</label>
                        </div>
                    </div>
                    <div class="label">
                        Jenis Kelamin
                    </div>
                    <div class="d-flex full mb-3 gap-4">
                        <div class="form-check">
                            <input class="form-check-input" <?=($data['jenis_kelamin']=="Male")?"checked":""?> type="radio" value="Male" name="jeniskelamin" id="male">
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" <?=($data['jenis_kelamin']=="Female")?"checked":""?> type="radio" value="Female" name="jeniskelamin" id="fmale">
                            <label class="form-check-label" for="fmale">
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="submitcontainer">
                        <input class="btn btn-primary" name="btnEdit" type="submit" value="Submit">
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
        
        var loadFile = function (event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
</body>
</html>
