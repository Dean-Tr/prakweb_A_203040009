<?php
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "", "prakweb_a_203040009_pw");

    return $conn;
}

// function untuk melakukan query dan memasukannya kedalam array
function query($sql)
{
    $conn = koneksi();
    $result = mysqli_query($conn, "$sql");

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload()
{
    $nama_file = $_FILES['img']['name'];
    $tipe_file = $_FILES['img']['type'];
    $ukuran_file = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tmp_file = $_FILES['img']['tmp_name'];

    // ketika tidak ada img yang di pilih
    if ($error == 4) {
        return 'nophoto.jpg';
    }

    // cek ekstensi file
    $daftar_img = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_img)) {
        echo "<script>
                alert('yang anda pilih bukan img!');
            </script>";
        return false;
    }

    // cek type file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png' && $tipe_file != 'image/jpg') {
        echo "<script>
                alert('yang anda pilih bukan img!');
            </script>";
        return false;
    }

    // cek ukuran file
    // maksimal 5Mb == 5000000
    if ($ukuran_file > 5000000) {
        echo "<script>
                alert('ukuran terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan
    // siap upload file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, '../img/' . $nama_file_baru);

    return $nama_file_baru;
}

// function untuk menambahkan data didalam database
function tambah($data)
{
    $conn = koneksi();

    // $img = htmlspecialchars($data['img']);
    $nama = htmlspecialchars($data['nama']);

    // upload img
    $img = upload();
    if (!$img) {
        return false;
    }

    $query = "INSERT INTO buku 
                VALUES
                (NULL, '$nama', '$img')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    $conn = koneksi();
    // menghapus img di folder img
    $b = query("SELECT * FROM buku WHERE id = $id");
    if ($b[0]['img'] != 'nophoto.jpg') {
        unlink('../img/' . $b[0]['img']);
    }


    mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    $conn = koneksi();

    $id = htmlspecialchars($data['id']);
    // $img = htmlspecialchars($data['img']);
    $nama = htmlspecialchars($data['nama']);
    $img_lama = htmlspecialchars($data['img_lama']);

    $img = upload();
    if (!$img) {
        return false;
    }

    if ($img == 'nophoto.jpg') {
        $img = $img_lama;
    }

    $query = "UPDATE buku SET
                nama = '$nama',
                img = '$img'
                WHERE id = $id";

    mysqli_query($conn, $query) or die(mysqli_error($conn));

    return mysqli_affected_rows($conn);
}
