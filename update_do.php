<?php
include 'Api/config.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{  
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
    $kode_mk = isset($_POST['kode_mk']) ? $_POST['kode_mk'] : '';
    $nama_mk = isset($_POST['nama_mk']) ? $_POST['nama_mk'] : '';
    $sks = isset($_POST['sks']) ? $_POST['sks'] : '';
    $nilai = isset($_POST['nilai']) ? $_POST['nilai'] : '';

    $url='http://localhost/UTS_PSAIT/Api/api.php?nim='.$nim.'';
    $ch = curl_init($url);
    $jsonData = array(
        'nim' => $nim,
        'nama' => $nama,
        'alamat' => $alamat,
        'tanggal_lahir' => $tanggal_lahir,
        'kode_mk' => $kode_mk,
        'nama_mk' => $nama_mk,
        'sks' => $sks,
        'nilai' => $nilai
    );

    $jsonDataEncoded = json_encode($jsonData);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

    $result = curl_exec($ch);

    if ($result === false) {
        echo "Curl request failed: " . curl_error($ch);
    } else {
        $result = json_decode($result, true);
        print("<center><br>status :  {$result["status"]} "); 
        print("<br>");
        print("message :  {$result["message"]} "); 
        echo "<br>Sukses mengupdate data di ubuntu server !";
        echo "<br><a href=index.php> OK </a>";
    }

    curl_close($ch);
}
?>