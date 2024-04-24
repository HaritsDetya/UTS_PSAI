<?php
include 'Api/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    $data = array(
        'nim' => $nim,
        'kode_mk' => $kode_mk,
        'nilai' => $nilai
    );

    $ch = curl_init('http://localhost/Api/api.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    curl_close($ch);

    // Redirect ke halaman utama setelah menambahkan data
    header('Location: index.php');
    exit;
}
?>
