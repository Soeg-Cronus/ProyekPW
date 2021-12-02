<?php 

    function JSONFileParser($path){
        $temp = file_get_contents($path);
        $temp = json_decode($temp, true);
        return $temp;
    }

    // echo "<pre>";
    // var_dump(JSONFileParser("Monitor.json"));
    // echo "</pre>"; JSONFileParser("Monitor.json");
    //JSONFiletoDatabase('vgacard.json', 'VGA', 'VGA');
    JSONFiletoDatabase('ram.json','RAM','RAM');


    function JSONFiletoDatabase($path, $kodehuruf3digit, $jenis){
        require_once("../backend/conn.php");
        $data = JSONFileParser($path);
        $c = 1;
        foreach ($data as $key => $value) {
            $random = random_int(1000,9999);
            $urut='';
            if ($c < 10) {
                $urut = '00'.$c;
            }
            else if ($c < 100) {
                $urut = '0'.$c;
            }
            else {
                $urut = $c;
            }
            $c++;
            $id = $kodehuruf3digit . $urut . $random;
            $nama = $value['title'];
            $harga = ($value['old-price'] == 0)?$value['new-price']:$value['old-price'];
            $stok = 9999;
            $jenisbarang = $conn->query("select id_jenis from daftar_jenis where jenis_barang = '$jenis'")->fetch_assoc();
            $jenisbarang = $jenisbarang['id_jenis'];
            $desc = json_encode($value['desc']);
            $url = $value['link-image'];
            // echo "<pre>";
            // var_dump($jenisbarang);
            // echo "</pre>";
            // echo $id . '<br>';
            // $response = $conn->query("insert into master_barang values ('$id', '$nama', $harga, $stok, $jenisbarang, '$desc', '$url')");
            $response = $conn->prepare("insert into master_barang values (?,?,?,?,?,?,?)");
            $response->bind_param("ssiiiss", $id, $nama, $harga, $stok, $jenisbarang, $desc, $url);
            
            if ($response->execute()) {
                echo "Berhasil add!" . "<br>";
            }
            else {
                echo "Gagal";
            }
        }
    }
?>