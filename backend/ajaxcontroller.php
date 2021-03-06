<?php 
    require_once("conn.php");
    $mode=$_REQUEST['mode'];

    if($mode == 'wishlist'){
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
        $jumlah = (int) $_REQUEST['jumlah'];

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
                'id-barang'=> $idbarang,
                'jumlah'=> $jumlah
            ];
            $cartencode = json_encode($cartbaru);

            $ambilharga = $conn->query("SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$idbarang' UNION SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$idbarang'")->fetch_assoc();
            $subtotal = $jumlah * $ambilharga['harga'] * (1 - $ambilharga['jumlah_diskon']);

            $insert = $conn->prepare("insert into cart values(?,?,?,?)");
            $insert->bind_param("ssis", $idcart, $cartencode, $subtotal, $username);
            $insert->execute();
            echo "Berhasil tambah barang di cart!";
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
                array_push($cartbaru, (object) array('id-barang'=> $idbarang, 'jumlah'=> $jumlah));
                $cartencode = json_encode($cartbaru);

                $ambilharga = $conn->query("SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$idbarang' UNION SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$idbarang'")->fetch_assoc();
                
                $subtotal = (int) $conn->query("select subtotal from cart where username='$username'")->fetch_object()->subtotal;
                $subtotal += $jumlah * $ambilharga['harga'] * (1 - $ambilharga['jumlah_diskon']);

                $insert = $conn->prepare("update cart set id_barang=?, subtotal=? where username=?");
                $insert->bind_param("sis", $cartencode, $subtotal, $username);
                $insert->execute();
                echo "Berhasil tambah barang di cart!";
            }
            else {
                $temp = (array) $cartbaru[$indexbarang];

                $temp['jumlah'] += $jumlah;
                (array) $cartbaru[$indexbarang] = $temp;
                $encoded = json_encode($cartbaru);

                $ambilharga = $conn->query("SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$idbarang' UNION SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$idbarang'")->fetch_assoc();
                
                $subtotal = (int) $conn->query("select subtotal from cart where username='$username'")->fetch_object()->subtotal;
                $subtotal += $jumlah * $ambilharga['harga'] * (1 - $ambilharga['jumlah_diskon']);

                $insert = $conn->prepare("update cart set id_barang=?, subtotal=? where username=?");
                $insert->bind_param("sis", $encoded, $subtotal, $username);
                $insert->execute();
                echo "Berhasil tambah jumlah barang di cart!";
            }
        }
    }
    else if ($mode == 'remove') {
        $id = $_REQUEST['id'];
        $user = $_REQUEST['user'];

        $usercart = $conn->query("SELECT * FROM cart WHERE username='$user'")->fetch_assoc();

        $cart = arrOfObjToArrOfArr($usercart['id_barang']);

        $removeIndex = -1;
        foreach ($cart as $key => $value) {
            if ($value['id-barang'] == $id) {
                $removeIndex = $key;
            }
        }
        
        $ambilharga = $conn->query("SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
                
        $subtotal = (int) $conn->query("select subtotal from cart where username='$user'")->fetch_object()->subtotal;
        if ($cart != null || $cart != '') {
            $subtotal -= $cart[$removeIndex]['jumlah'] * $ambilharga['harga'] * (1 - $ambilharga['jumlah_diskon']);
        }
        else {
            $subtotal = 0;
        }

        unset($cart[$removeIndex]);

        $cart = arrOfArrToArrOfObj($cart);
        
        $newcart = json_encode($cart);
        
        $conn->query("UPDATE cart SET id_barang='$newcart', subtotal=$subtotal WHERE username='$user'");

        $finalcart;

        $requeried = $conn->query("SELECT * FROM cart WHERE username='$user'")->fetch_assoc();
        $newcart = json_decode($requeried['id_barang']);
        
        foreach ($newcart as $key => $value) {
            $value = (array) $value;
            $id = $value['id-barang'];
            $datacart = $conn->query("SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb LEFT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb RIGHT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
            $preview = $datacart + $value;
            $finalcart[] = $preview;
        }
        
        echo json_encode($finalcart);
    }
    else if ($mode == 'select cart') {
        $idbarang = $_REQUEST['id'];
        $username = $_REQUEST['user'];

        $cart = $conn->query("select * from cart where username='$username'")->fetch_assoc();
        $newcart = json_decode($cart['id_barang']);
        $jumlahbarang = count($newcart);
        $finalcart = [];

        foreach ($newcart as $key => $value) {
            $value = (array) $value;
            $id = $value['id-barang'];
            $datacart = $conn->query("SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb LEFT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb RIGHT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
            $preview = $datacart + $value;
            $finalcart[] = $preview;
        }

        $arrayview = [
            'view'=>"",
            'total'=>"",
            'itotal'=>0,
            'jumlah_item'=>0
        ];

        $total = 0;
        foreach ($finalcart as $key => $value) {
            if ($key == count($finalcart) - 1) {
                $arrayview['view'] .= "<div class='row border-top border-bottom'>\n";
            }
            else {
                $arrayview['view'] .= "<div class='row border-top'>\n";
            }
            $arrayview['view'] .=    "<div class='row main align-items-center'>";
            $arrayview['view'] .=        "<div class='col-2'>";
            $arrayview['view'] .=            "<img class='img-fluid' src='" . $value['urlgambar'] . "' alt='" . str_replace('"', '&quot;', $value['nama_barang']) ."'>";
            $arrayview['view'] .=        "</div>";
            $arrayview['view'] .=        "<div class='col'>";
            $arrayview['view'] .=            "<div class='row text-muted'>";
            $arrayview['view'] .=                $value['jenis_barang'];
            $arrayview['view'] .=            "</div>";
            $arrayview['view'] .=            "<div class='row'>";
            $arrayview['view'] .=                $value['nama_barang'];
            $arrayview['view'] .=            "</div>";
            $arrayview['view'] .=        "</div>";
            $arrayview['view'] .=        "<div class='col'>";
            $arrayview['view'] .=            "<input type='number' onchange='changeJumlah(\"" . $value['id_barang']. "\", \"" . $username . "\", event)' value='" . $value['jumlah'] . "' name='jmlh' min='1' max='100'>\n";
            $arrayview['view'] .=            "<button type='button' onclick='removeBarang(\"" . $value['id_barang']. "\", \"" . $username . "\")' style='border: none; border-radius: 5px; background-color: red; color: white; height: 25px; width: 25px; transform: translateY(1.5px);'>";
            $arrayview['view'] .=                "&#10005;";
            $arrayview['view'] .=            "</button>";
            $arrayview['view'] .=        "</div>";
            $arrayview['view'] .=        "<div class='col'>";
            $arrayview['view'] .=            ($value['jumlah_diskon'] == null) ? rupiah($value['harga']) : rupiah($value['harga'] * (1 - $value['jumlah_diskon']));
            $arrayview['view'] .=            "\n<span class='close'> &#10005; </span>\n";
            $arrayview['view'] .=            $value['jumlah'];
            $arrayview['view'] .=        "</div>";
            $arrayview['view'] .=    "</div>";
            $arrayview['view'] .= "</div>";
        
            $total += $value['jumlah'] * $value['harga'] * (1 - $value['jumlah_diskon']);
        }

        $arrayview['total'] = rupiah($total);
        $arrayview['itotal'] = $total;
        $arrayview['jumlah_item'] = $jumlahbarang;

        echo json_encode($arrayview);
                    
    }
    else if ($mode == 'update jumlah') {
        $id = $_REQUEST['id'];
        $user = $_REQUEST['user'];
        $jml = (int) $_REQUEST['new_jumlah'];

        $usercart = $conn->query("SELECT * FROM cart WHERE username='$user'")->fetch_assoc();

        $cart = arrOfObjToArrOfArr($usercart['id_barang']);

        $removeIndex = -1;
        foreach ($cart as $key => $value) {
            if ($value['id-barang'] == $id) {
                $removeIndex = $key;
            }
        }

        $ambilharga = $conn->query("SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.id_barang, mb.harga, d.jumlah_diskon FROM master_barang mb RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
                
        $subtotal = (int) $conn->query("select subtotal from cart where username='$user'")->fetch_object()->subtotal;
        $subtotal += ($jml - $cart[$removeIndex]['jumlah']) * $ambilharga['harga'] * (1 - $ambilharga['jumlah_diskon']);
        
        $cart[$removeIndex]['jumlah'] = $jml;

        $cart = arrOfArrToArrOfObj($cart);
        
        $newcart = json_encode($cart);
        
        $conn->query("UPDATE cart SET id_barang='$newcart', subtotal=$subtotal WHERE username='$user'");

        $finalcart;

        $requeried = $conn->query("SELECT * FROM cart WHERE username='$user'")->fetch_assoc();
        $newcart = json_decode($requeried['id_barang']);
        
        foreach ($newcart as $key => $value) {
            $value = (array) $value;
            $id = $value['id-barang'];
            $datacart = $conn->query("SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb LEFT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang LEFT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id' UNION SELECT mb.*, dj.jenis_barang, d.jumlah_diskon FROM master_barang mb RIGHT JOIN daftar_jenis dj ON dj.id_jenis = mb.id_jenis_barang RIGHT JOIN diskon d ON d.id_barang = mb.id_barang WHERE mb.id_barang = '$id'")->fetch_assoc();
            $preview = $datacart + $value;
            $finalcart[] = $preview;
        }
        
        echo json_encode($finalcart);
    }
    else if ($mode == 'select shipment') {
        $pengiriman = $conn->query("select * from pengiriman")->fetch_all(MYSQLI_ASSOC);
        foreach ($pengiriman as $key => $value) {
            $pengiriman[$key]['harga'] = rupiah($value['harga']);
        }
        echo json_encode($pengiriman);
    }
    else if ($mode == 'ganti shipment') {
        $id = $_REQUEST['id_shipment'];
        $pengiriman = $conn->query("select * from pengiriman where id_pengiriman='$id'")->fetch_assoc();
        echo json_encode($pengiriman);
    }
    else if ($mode == 'cout') {
        $iduser = $_REQUEST['id'];
        $idshipment = $_REQUEST['idShipping'];

        $lastbarang = $conn->query("select * from cart where username='$iduser'")->fetch_assoc();
        $subtotal = (int) $lastbarang['subtotal'];
        $barang = $lastbarang['id_barang'];

        $transaction = $conn->query("select * from transaksi")->fetch_all(MYSQLI_ASSOC);
        $jumlahtrans = count($transaction)+1;
        $idtrans = '';
        if($jumlahtrans < 10) {
            $idtrans = 'T000' . $jumlahtrans;
        }
        else if ($jumlahtrans < 100) {
            $idtrans = 'T00' . $jumlahtrans;
        }
        else if ($jumlahtrans < 1000) {
            $idtrans = 'T0' . $jumlahtrans;
        }
        else if ($jumlahtrans < 10000) {
            $idtrans = 'T' . $jumlahtrans;
        }
        $biayapengiriman = (int) $conn->query("select * from pengiriman where id_pengiriman='$idshipment'")->fetch_object()->harga;
        $grtotal = $subtotal + $biayapengiriman;

        $conn->query("insert into transaksi values ('$idtrans', NOW(), '$barang', $subtotal, $grtotal, '$idshipment', '$iduser','','','','')");
        $conn->query("update cart set id_barang='[]', subtotal=0 where username='$iduser'");
        echo json_encode(array(
            'total'=>$grtotal, 
            'transId'=>$idtrans
        ));
        
    }
    else if ($mode == 'catatPID') {
        $idtrans = $_REQUEST['transid'];
        $jsonpayment = $_REQUEST['paymentid'];
        $jsonpayment = (array)json_decode($jsonpayment);
        if (array_key_exists('payment_code', $jsonpayment)) {
            $payment = $jsonpayment['payment_code'];
            $conn->query("update transaksi set payment_code='$payment' where id_transaksi='$idtrans'");
        }
        echo $jsonpayment['finish_redirect_url'];
    }

    function arrOfObjToArrOfArr($cart) {
        $temp = [];
        $cart = json_decode($cart);
        foreach ($cart as $key => $value) {
            $value = (array) $value;
            array_push($temp, $value);
        }
        return $temp;
    }

    function arrOfArrToArrOfObj($cart) {
        $temp = [];
        foreach ($cart as $key => $value) {
            $value = (object) $value;
            array_push($temp, $value);
        }
        return $temp;
    }

?>