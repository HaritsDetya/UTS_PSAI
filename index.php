<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nilai Mahasiswa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
  </script>
</head>
<body>
  <div class="container">
    <h1 class="mt-5">Nilai Mahasiswa</h1>
    <div class="mt-5">
      <h2>Daftar Nilai Mahasiswa</h2>
      <table class="table">
        <thead>
          <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Kode MK</th>
            <th>Nama MK</th>
            <th>SKS</th>
            <th>Nilai</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once "Api/config.php";
            $curl= curl_init();
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT/Api/api.php');
          $res = curl_exec($curl);
          $json = json_decode($res, true);
            if ($json && isset($json['status']) && $json['status'] == 1 && isset($json['data']) && !empty($json['data'])) {
                    
            usort($json['data'], function ($a, $b) {
              return strcmp($a['nama'], $b['nama']);
            });
                echo "<tbody>";
                for ($i = 0; $i < count($json["data"]); $i++){
                   echo "<tr>";
                    echo '<td>'.$json["data"][$i]["nim"].'</td>';
                    echo '<td>'.$json["data"][$i]["nama"].'</td>';
                    echo '<td>'.$json["data"][$i]["alamat"].'</td>';
                    echo '<td>'.$json["data"][$i]["tanggal_lahir"].'</td>';
                    echo '<td>'.$json["data"][$i]["nama_mk"].'</td>';
                    echo '<td>'.$json["data"][$i]["kode_mk"].'</td>';
                    echo '<td>'.$json["data"][$i]["sks"].'</td>';
                    echo '<td>'.$json["data"][$i]["nilai"].'</td>';
                    echo "<td>";
                      echo '<a href="update.php?nim='.$json["data"][$i]["nim"] .'" class="mr-3" title="Update Record"><span class="btn btn-secondary">Update</span></a>';
                      echo '<a href="delete.php?nim='. $json["data"][$i]["nim"] .'" title="Delete Record"><span class="btn btn-danger">Delete</span></a>';
                    echo "</td>";
                  echo "</tr>";
                }
                echo "</tbody>";                            
              echo "</table>";
            }

          curl_close($curl);?>
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      <a href="add.php" class="btn btn-primary">Tambah Data</a>
    </div>
  </div>
</body>
</html>
