<?php
require 'php/functions.php';

// Melakukan koneksi ke database
//$conn = mysqli_connect('localhost', 'root', '', 'prakweb_a_203040009_pw');

// Melakukan Query dari database
//$result = mysqli_query($conn, "SELECT * FROM buku");

//$rows = [];
//while ($row = mysqli_fetch_assoc($result)) {
//    $rows[] = $row;
//}

$buku = query("SELECT * FROM buku");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="warnaAbu">
    <h3 class="text-center p-3 pb-0">Daftar Buku Terbaik</h3>
    <div class="container">
        <!-- tombol tambah data -->
        <div class="d-flex justify-content-center mt-3">
            <a href="php/tambah.php" class="text-decoration-none">
                <button type="button" class="btn btn-warning my-0 mx-1">Tambah Data</button>
            </a>
        </div>

        <div class="d-flex my-2 bd-highlight flex-wrap justify-content-center">
            <?php foreach ($buku as $b) : ?>
                <div class="border border-4 border-black text-center rounded bd-highlight m-3 col-auto mr-auto">

                    <!-- gambar -->
                    <div class="p-3">
                        <img src="img/<?= $b["img"]; ?>" width="230" height="346">
                    </div>

                    <!-- nama gambar -->
                    <div class="text-center pb-3 text-decoration-none" style="width: 230; margin: auto;">
                        <p style="margin: auto;"><?= $b["nama"]; ?></p>
                    </div>

                    <!-- tombol ubah dan hapus -->
                    <div class="d-flex justify-content-around mb-3">
                        <a href="php/ubah.php?id=<?= $b['id']; ?>">
                            <button type="button" class="btn btn-primary">Ubah</button>
                        </a>
                        <a href="php/hapus.php?id=<?= $b['id']; ?>" onclick="return confirm('Hapus Data??')">
                            <button type="button" class="btn btn-danger">Hapus</button>
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>