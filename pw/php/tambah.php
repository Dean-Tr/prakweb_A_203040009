<?php
require 'functions.php';

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
    alert('Data berhasil ditambahkan!');
    document.location.href = '../index.php';
    </script>";
    } else {
        echo "<script>
    alert('Data gagal ditambahkan!');
    document.location.href = '../index.php';
    </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Tambah Data</title>
</head>

<body class="">
    <h3 class="text-center p-3 pb-0">Tambah Data Buku</h3>
    <div class="container">
        <form action="" method="POST" class="mx-3 mb-3 row g-3" enctype="multipart/form-data">
            <div class="col-12">
                <label class="form-label">
                    Nama:
                    <input type="text" name="nama" id="nama" size="1000" required class="form-control">
                </label>
            </div>

            <div class="col-12">
                <label class="form-label">
                    Gambar:
                    <input type="file" name="img" id="img" class="form-control img" onchange="previewImage()">
                </label>
                <img src="../img/nophoto.jpg" width="230" height="346" style="display: block;" class="img-preview">
            </div>

            <div class="col-12 mt-0">
                <br>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data!</button>
                <a href="../index.php"><button type="button" class="btn btn-success">Kembali</button></a>
            </div>
        </form>
    </div>

    <script>
        function previewImage() {
            const img = document.querySelector('.img');
            const imgPreview = document.querySelector('.img-preview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }
    </script>
</body>

</html>