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
    } else {
        header("Location: index.php");
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

    if (isset($_REQUEST["cari"])) {
        header("Location: index.php?" . http_build_query(array('q' => $_REQUEST['q'])));
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
    <!-- table--> 
    <table class="cart-table account-table table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Barang</th>
					</tr>
				</thead>
				<tbody>

				<?php
					$wishsql = "SELECT * from wishlist";
					$wishres = mysqli_query($conn, $wishsql);
					while($wishr = mysqli_fetch_assoc($wishres)){
				?>
					<tr>
						<td>
							<?php echo $wishr['id_wishlist']; ?>
						</td>
						<td>
							 <?php echo $wishr['id_barang']; ?>
						</td>
						<td>
							<?php echo $wishr['username']; ?>			
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>	
    
</body>

</html>