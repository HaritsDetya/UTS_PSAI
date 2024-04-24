<?php
include 'Api/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];

    $url='http://localhost/UTS_PSAIT/Api/api.php?nim=' . $nim . '&kode_mk=' . $kode_mk;;


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    curl_close($ch);

    //var_dump($result);
    // tampilkan return statusnya, apakah sukses atau tidak
    print("<center><br>status :  {$result["status"]} "); 
    print("<br>");
    print("message :  {$result["message"]} "); 
    //
    echo "<br>Sukses menghapus data di ubuntu server !";
    echo "<br><a href=index.php> OK </a>";
}
?>