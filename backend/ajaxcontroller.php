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
            }
        }

        // $insert=$conn->prepare("insert into wishlist(id_wishlist,id_barang,username) values(?,?,?)");
        // $insert->bind_param("sss",$idwishlist)
        
    }
?>