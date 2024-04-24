<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
            if(!empty($_GET["nim"]))
            {
                $nim=$_GET["nim"];
                echo json_encode(getNilaiMahasiswaByNim($nim));
            }
            else
            {
                echo json_encode(getAllNilaiMahasiswa());
            }
            break;
    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
            if(!empty($input["nim"]) && !empty($input["kode_mk"]) && isset($input["nilai"]))
            {
                $nim = $_POST['nim'];
                $kode_mk = $_POST['kode_mk'];
                $nilai = $_POST['nilai'];
                insertNilaiMahasiswa($nim, $kode_mk, $nilai);
            }
            else
            {
                header("HTTP/1.0 400 Bad Request");
                echo json_encode(array("status" => 0, "message" => "Missing POST data"));
            }     
            break;
    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"]) && isset($input["nilai"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            $nilai = $input["nilai"];
            updateNilaiMahasiswa($nim, $kode_mk, $nilai);
        } else {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("message" => "Missing PUT data"));
        }
        break;
    case 'DELETE':
        if (!empty($_GET["nim"]) && !empty($_GET["kode_mk"])) {
            $nim = $_GET["nim"];
            $kode_mk = $_GET["kode_mk"];
            deleteNilaiMahasiswa($nim, $kode_mk);
        } else {
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("message" => "Missing data"));
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
 }

   function getAllNilaiMahasiswa()
   {
      global $mysqli;
      $query="SELECT
      mahasiswa.nim,
      mahasiswa.nama,
      mahasiswa.alamat,
      mahasiswa.tanggal_lahir,
      matakuliah.kode_mk,
      matakuliah.nama_mk,
      matakuliah.sks,
      perkuliahan.nilai
  FROM
      perkuliahan AS perkuliahan
  INNER JOIN
      mahasiswa AS mahasiswa ON mahasiswa.nim = perkuliahan.nim
  INNER JOIN
      matakuliah AS matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk;
  ";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
        'status' => 1,
        'message' =>'Get All Nilai Mahasiswa Successfully.',
        'data' => $data
     );
    header('Content-Type: application/json');
    echo json_encode($response);
   }
 
   function getNilaiMahasiswaByNim($nim)
   {
      global $mysqli;
      $query="SELECT
      mahasiswa.nim,
      mahasiswa.nama,
      mahasiswa.alamat,
      mahasiswa.tanggal_lahir,
      matakuliah.kode_mk,
      matakuliah.nama_mk,
      matakuliah.sks,
      perkuliahan.nilai
  FROM
      perkuliahan
  INNER JOIN
      mahasiswa ON mahasiswa.nim = perkuliahan.nim
  INNER JOIN
      matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk
  WHERE
      perkuliahan.nim = '$nim';
  ";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
        'status' => 1,
        'message' =>'Get Nilai Mahasiswa By NIM Successfully.',
        'data' => $data
     );
    header('Content-Type: application/json');
    echo json_encode($response);
   }
 
   function insertNilaiMahasiswa($nim, $kode_mk, $nilai)
    {
        global $mysqli;

        $query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) 
        VALUES ('$nim', '$kode_mk', $nilai)";
        if ($mysqli->query($query)) {
            echo json_encode(array("status" => 1, "message" => "Nilai Mahasiswa inserted successfully"));
        } 
        else {
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode(array("status" => 0, "message" => "Failed to insert Nilai Mahasiswa"));
        }
    }
 
   function updateNilaiMahasiswa($nim, $kode_mk, $nilai)
      {
         global $mysqli;
         if(!empty($_POST["nim"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nim' => '','kode_mk' => '', 'nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE perkuliahan SET
                nim = '$data[nim]',
                kode_mk = '$data[kode_mk]',
                nilai = '$data[nilai]'
                WHERE nim='$data[nim]' AND kode_mk='$data[kode_mk]'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Nilai Mahasiswa Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Nilai Mahasiswa Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function deleteNilaiMahasiswa($nim, $kode_mk)
   {
      global $mysqli;
      $query="DELETE FROM perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'";
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Nilai Mahasiswa Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Nilai Mahasiswa Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
?> 
