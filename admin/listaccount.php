<?php session_start();
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/external/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cssoverview.css">
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
    <main class="fluid-container">
    <div id="sidenav" class="flex-shrink-0 p-3 text-white" style="width: 280px;">
            <a href="/" class="d-flex align-items-center isDisabled title-disabled pb-3 mb-3 link-dark text-decoration-none border-bottom justify-content-between">
                <span class="fs-5 fw-semibold" style="color: #1ad3be">Welcome, <?=$idactive?>!</span>
            </a>
            <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    <a href="index.php" style="color: #1ad3be; text-decoration:none;">Home</a> 
                </button>
            </li>
            </li>
            <li class="mb-1">
                <button style="color: #1ad3be" class="btn btn-toggle shadow-none align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                </button>
                <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="../admin/addaccount.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">Add Admin</a></li>
                    <li><a href="../admin/listaccount.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">List Admin</a></li>
                    <li><a href="../admin/additem.php" class="link-dark rounded <?=($unameactive != 'owner')?'isDisabled':''?>" style="color: #1ad3be">Add Barang</a></li>
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
                <div class="judul" style="color: #1ad3be;">
                    <h1>List Admin</h1>
                </div>
                <div class="formcontainer">
                    <form action="" method="POST">
                        <table class="table table-striped" style="color: #1ad3be; border-color:#1ad3be;width: 50vw;">
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
                                    <tr style="color: #1ad3be">
                                        <th scope="row" style="color: #1ad3be"><?=$c++;?></th>
                                        <td style="color: #1ad3be"><?=$value['username']?></td>
                                        <td style="color: #1ad3be"><?=$value['nama']?></td>
                                        <td style="width: 500px;">
                                            <button class="btn btn-sm btn-danger" value='<?=$value['username']?>' name="btnDelete" type="submit">Delete</button>
                                            <!-- <button class="btn btn-sm btn-success"  name="btnReset" type="button">Reset Password</button> -->

                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal-<?=$value['username']?>">Reset Password</button>

                                            <div class="modal fade" id="exampleModal-<?=$value['username']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" >
                                                    <div class="modal-content" style="color: #1ad3be; background-color: #222d32">
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
