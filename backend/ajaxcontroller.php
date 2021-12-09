<?php 
    require_once("conn.php");
    $mode=$_REQUEST['mode'];

    if($mode=='wishlist'){
        $id=$_REQUEST['id'];
        $aktif=$_REQUEST['yg_aktif'];
        $wishlist=$conn->query("select * from wishlist")->fetch_all(MYSQLI_ASSOC);
        $jumlahwishlist=count($wishlist)+1;
        $idwishlist='';
        if($jumlahwishlist<10){
            $idwishlist='W000'.$jumlahwishlist;
        }
        else if($jumlahwishlist<100){
            $idwishlist='W00'.$jumlahwishlist;
        }
        else if($jumlahwishlist<1000){
            $idwishlist='W0'.$jumlahwishlist;
        }
        else if($jumlahwishlist<10000){
            $idwishlist='W'.$jumlahwishlist;
        }

        $wishlistuser=$conn->query("select * from wishlist where username='$aktif'")->fetch_assoc();
        if($wishlistuser==null){
            $wishbaru= [$id];
            $wishencode=json_encode($wishbaru);
            $insert=$conn->prepare("insert into wishlist(id_wishlist,id_barang,username) values(?,?,?)");
            $insert->bind_param("sss",$idwishlist,$wishencode,$aktif);
            $insert->execute();
        }
        else{
            $pernahada=false;
            $wishbaru=json_decode($wishlistuser['id_barang']);
            foreach ($wishbaru as $key => $value) {
                if($value==$id){
                    $pernahada=true;
                }
            }
            if(!$pernahada){
                array_push($wishbaru,$id);
                $wishencode=json_encode($wishbaru);
                $insert=$conn->prepare("update wishlist set id_barang=? where username=?");
                $insert->bind_param("ss",$wishencode,$aktif);
                $insert->execute();
                echo "Berhasil tambah wishlist!";
            }
            else {
                echo "Barang sudah ada di wishlist!";
            }
        }

        // echo json_decode(json_encode($wishlistuser['id_barang']));
        // $insert=$conn->prepare("insert into wishlist(id_wishlist,id_barang,username) values(?,?,?)");
        // $insert->bind_param("sss",$idwishlist)
        
    }
    else if ($mode == 'cart') {
        $idbarang = $_REQUEST['id'];
        $username = $_REQUEST['user'];
        $jumlah = $_REQUEST['jumlah'];

        $cart = $conn->query("select * from cart")->fetch_all(MYSQLI_ASSOC);
        $jumlahcart = count($cart)+1;
        $idcart = '';
        if($jumlahcart < 10) {
            $idcart = 'C000' . $jumlahcart;
        }
        else if ($jumlahcart < 100) {
            $idcart = 'C00' . $jumlahcart;
        }
        else if ($jumlahcart < 1000) {
            $idcart = 'C0' . $jumlahcart;
        }
        else if ($jumlahcart < 10000) {
            $idcart = 'C' . $jumlahcart;
        }

        $cartuser = $conn->query("select * from cart where username='$username'")->fetch_assoc();
        
        // pengecekan username punya cart atau belum
        if($cartuser == null) {
            $cartbaru[] = [
                'id-barang'=>$idbarang,
                'jumlah'=> (int) $jumlah
            ];
            $cartencode = json_encode($cartbaru);
            $insert = $conn->prepare("insert into cart values(?,?,?)");
            $insert->bind_param("sss", $idcart, $cartencode, $username);
            $insert->execute();
        }
        else {
            $pernahada = false;
            $cartbaru = json_decode($cartuser['id_barang']);
            $indexbarang = -1;
            // setiap barang yang dimiliki user x
            foreach ($cartbaru as $key => $value) {
                $arrayvalue = (array) $value;
                if ($arrayvalue['id-barang'] == $idbarang) {
                    $pernahada = true;
                    $indexbarang = $key;
                }
            }
            if (!$pernahada) {
                array_push($cartbaru, (object) array('id-barang'=>$idbarang, 'jumlah'=> (int) $jumlah));
                $cartencode = json_encode($cartbaru);
                $insert = $conn->prepare("update cart set id_barang=? where username=?");
                $insert->bind_param("ss", $cartencode, $username);
                $insert->execute();
                echo "Berhasil tambah barang di cart!";
            }
            else {
                $temp = (array) $cartbaru[$indexbarang];
                $temp['jumlah'] += (int) $jumlah;
                (array) $cartbaru[$indexbarang] = $temp;
                $encoded = json_encode($cartbaru);
                $insert = $conn->prepare("update cart set id_barang=? where username=?");
                $insert->bind_param("ss", $encoded, $username);
                $insert->execute();
                echo "Berhasil tambah jumlah barang di cart!";
            }
        }
    }
?>