<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
 $nim = $_GET["nim"];
 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_URL, 'http://localhost/UTS_PSAIT/Api/api.php?nim='.$nim.'');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Data</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="update_do.php" method="post">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?php echo $_GET["nim"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $_GET["nama"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="mobile" name="alamat" class="form-control" value="<?php echo $_GET["alamat"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" name="tanggal_lahir" class="form-control" value="<?php echo $_GET["tanggal_lahir"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Kode MK</label>
                            <input type="text" name="kode_mk" class="form-control" value="<?php echo $_GET["kode_mk"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama MK</label>
                            <input type="text" name="nama_mk" class="form-control" value="<?php echo $_GET["nama_mk"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>SKS</label>
                            <input type="text" name="sks" class="form-control" value="<?php echo $_GET["sks"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" name="nilai" class="form-control" value="<?php echo $_GET["nilai"]; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>