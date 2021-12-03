<?php
    require_once("backend/conn.php");
    
    if(isset($_POST["add"])){

        $result =false;
        if(isset($nama) && $nama!=""
        && isset($harga) && $harga!=""
        && isset($stok) && $stok!=""
        && isset($jenis) && $jenis!=""
        && isset($desc) && $desc!=""
        
        ){
            $nama = $_POST["nama"];
            $harga = $_POST["harga"];
            $stok = $_POST["stok"];
            $jenis = $_POST["jenis"];
            $desc = $_POST["deskripsi"];

            // id generation
            $kode = "MB";
            $temprand = random_int(0,9999);
            $tempcurrtime = substr( time(),-4);
            $id = $kode.$temprand.$tempcurrtime;
            $stmt = $conn->prepare("INSERT INTO MASTER_BARANG(id_barang,nama_barang,harga,stok,jenis_barang,deskripsi) VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("ssiiss",$id, $nama, $harga, $stok, $jenis, $desc);
            $result =$stmt->execute();

        }else{
                echo "<script>alert('Mohon data diisi semua')</script>";
        }
    }
    if(isset($_POST["addjenis"])){
        if(isset($_POST["lbaddjenis"])){
            $stmt = $conn->prepare("INSERT INTO DAFTAR_JENIS(jenis_barang) VALUES(?)");
            $stmt->bind_param("s",$_POST["lbaddjenis"]);
            $result =$stmt->execute();
            echo "<script>alert('Berhasil Tambah Jenis')</script>";
        }else{
            echo "<script>alert('value jenis barang tidak valid')</script>";
        }

    }
    
    if($result){
    $_SESSION["message"] = "Berhasil add nih";
    }else{
    $_SESSION["message"] = "Gagal add nih!";
    }
    $stmt = $conn->prepare("SELECT * FROM daftar_jenis");
    $stmt->execute();
    $djenis = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

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
        <label for="cars">Masukkan jenis:</label>

<select name="jenis" id="jenis">
    <?php
                            if ($djenis !== null) {
                                foreach ($djenis as $key => $value) {
    ?>
<option value='<?= $value["jenis_barang"] ?>'> <?= $value["jenis_barang"] ?></option>
<?php
                                }
                            }
?>
</select>
<br>
        deskripsi : <br>
        <input type="text" name="deskripsi" id=""> <br>
        <button name="add">tambah barang!</button>

Tidak melihat kategori Anda? <br>
Tambah kategori baru !! <br>
<input type="text" name="lbaddjenis" id="lbaddjenis"> <br>
        <button name="addjenis">tambah jenis!</button><br>
        <!-- TODO: harusnya dibawah ini bisa uplod gambar -->

    </form>

</body>
</html>