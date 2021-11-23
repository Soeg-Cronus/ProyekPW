<?php
    require_once("backend/conn.php");
    
    $stmt = $conn->prepare("SELECT * FROM masterbarang");
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    if(isset($_POST["cari"])){
        $stmt = $conn->prepare("SELECT * FROM masterbarang WHERE nama_barang like ?");
        $keyword = "%".$_POST["nama"]."%";
        $stmt->bind_param("s" ,$keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
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
        Search : <br>
        <input type="text" name="nama" id="">
        <button name="cari">Cari !</button>
        <!-- TODO: harusnya dibawah ini kategori -->

    </form>
    <table border="2">
        <thead>
            <tr>
                <th>No</th>
                <th>Id</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Jenis</th>
                <th>Desc</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    if ($items !== null) {
                        foreach ($items as $key => $value) {
                    ?>
                      <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= $value["id_barang"] ?></td>
                        <td><?= $value["nama_barang"] ?></td>
                        <td><?= $value["harga"] ?></td>
                        <td><?= $value["stok"] ?></td>
                        <td><?= $value["jenis_barang"] ?></td>
                        <td><?= $value["deskripsi"] ?></td>
                      </tr>
                    <?php
                        }
                    }
            ?>
        </tbody>
    </table>

</body>
</html>