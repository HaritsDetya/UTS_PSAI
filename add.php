<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Tambah Nilai Mahasiswa</h1>
        <form action="add_do.php" method="POST" class="mt-5">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kode_mk">Kode MK:</label>
                <input type="text" id="kode_mk" name="kode_mk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <input type="text" id="nilai" name="nilai" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
