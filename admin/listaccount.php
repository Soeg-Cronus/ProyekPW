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
    <link rel="stylesheet" href="css/stylelist.css">
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

        if (isset($_REQUEST['btnDelete'])) {
            // echo "<script>alert('".$_REQUEST['btnDelete']."')</script>";
            $userdelete = $_REQUEST['btnDelete'];
            $resultdelete = $conn->query("delete from admin where username='$userdelete'");
            if (!$resultdelete) {
                echo "<script>alert('Gagal delete!')</script>";
            }
            else {
                echo "<script>alert('Berhasil delete!')</script>";
            }
        }
        
        if (isset($_REQUEST['btnReset'])) {
            $userselected = $_REQUEST['btnReset'];

            if ($_REQUEST['newPass-'.$userselected] != "") {
                $hashed = $_REQUEST['newPass-'.$userselected];
                echo "<script>alert('".$hashed.' '.$userselected ."')</script>";
                
                $hashed = md5($_REQUEST['newPass-'.$userselected]);
                $stmt = $conn->prepare("update admin set password=? where username=?");
                $stmt->bind_param("ss", $hashed, $userselected);
                if ($stmt->execute()) {
                    echo "<script>alert('Berhasil ganti password')</script>";
                    // header("Location: listaccount.php");
                }
                else {
                    echo "<script>alert('Gagal ganti password')</script>";
                }
            }
        }

        $alladmin = $conn->query("select * from admin where username != '$unameactive'")->fetch_all(MYSQLI_ASSOC);
        

    ?>
    <main class="fluid-container">
        <div id="sidenav" class="flex-shrink-0 sidebar p-3 text-white" style="width: 13vw;">
            <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom justify-content-between">
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
                    <li><a href="../admin/listaccount.php" class="link-dark isActive rounded">List Admin</a><i class="arrow left"></i></li>
                    <li><a href="../admin/setting.php" class="link-dark rounded">Settings</a></li>
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
                    <h1>List Admin</h1>
                </div>
                <div class="formcontainer">
                    <form action="" method="POST">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th style="width: 20%;" scope="col">Username</th>
                                    <th scope="col">Name</th>
                                    <th style="width: 32%;" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $c = 1;
                                    foreach ($alladmin as $key => $value) {
                                        
                                ?>
                                    <tr>
                                        <th scope="row"><?=$c++;?></th>
                                        <td><?=$value['username']?></td>
                                        <td><?=$value['nama']?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" value='<?=$value['username']?>' name="btnDelete" type="submit">Delete</button>
                                            <!-- <button class="btn btn-sm btn-success"  name="btnReset" type="button">Reset Password</button> -->

                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal-<?=$value['username']?>">Reset Password</button>

                                            <div class="modal fade" id="exampleModal-<?=$value['username']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel-<?=$value['username']?>">Reset Password</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- <form> -->
                                                                <div class="mb-3">
                                                                    <label for="new-password<?=$value['username']?>" class="col-form-label">New Password:</label>
                                                                    <input type="password" class="form-control" name="newPass-<?=$value['username']?>" id="new-password-<?=$value['username']?>">
                                                                    <input type="checkbox" onclick="showPass('<?=$value['username']?>')">&nbsp;Show Password
                                                                </div>
                                                            <!-- </form> -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" value='<?=$value['username']?>' name="btnReset" class="btn btn-success">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php 
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </form>
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

        function showPass(e) {
            var x = document.getElementById("new-password-"+e);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
