<?php
    require_once("backend/conn.php");
    
    if(isset($_POST["add"])){
        $nama = $_POST["nama"];
        $harga = $_POST["harga"];
        $stok = $_POST["stok"];
        $jenis = $_POST["jenis"];
        $desc = $_POST["deskripsi"];

        $result =false;
        if(isset($nama) && $nama!=""
        && isset($harga) && $harga!=""
        && isset($stok) && $stok!=""
        && isset($jenis) && $jenis!=""
        && isset($desc) && $desc!=""
        
        ){

            // id generation
            $kode = "MB";
            $temprand = random_int(0,9999);
            $tempcurrtime = substr( time(),-4);
            $id = $kode.$temprand.$tempcurrtime;
            // var_dump($id);
            $stmt = $conn->prepare("INSERT INTO MASTERBARANG(id_barang,nama_barang,harga,stok,jenis_barang,deskripsi) VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("ssiiss",$id, $nama, $harga, $stok, $jenis, $desc);
            $result =$stmt->execute();
        }else{
            echo "<script>alert('Mohon data diisi semua')</script>";
        }
        
        if($result){
        $_SESSION["message"] = "Berhasil add nih";
        }else{
        $_SESSION["message"] = "Gagal add nih!";
        }


    }

    //TODO: biar ga bisa ditembak url

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        nama barang : <br>
        <input type="text" name="nama" id=""> <br>
        harga : <br>
        <input type="text" name="harga" id="" pattern="[0-9]{0,100}" title="Tolong memasukkan bilangan positif"> <br>
        stok : <br>
        <input type="text" name="stok" id="" pattern="[0-9]{0,100}" title="Tolong memasukkan bilangan positif"> <br>
        jenis barang : <br>
        <input type="text" name="jenis" id=""> <br>
        deskripsi : <br>
        <input type="text" name="deskripsi" id=""> <br>
        <button name="add">tambah barang!</button>
        <!-- TODO: harusnya dibawah ini bisa uplod gambar -->

    </form>

</body>
</html>