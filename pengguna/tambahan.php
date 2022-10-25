<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login, klik <a href=\"../index.php\">disini</a> untuk login");
} else {
    $username = $_SESSION['username'];
}

$kode = $_GET['id'];
$username = $_SESSION['username'];
$nama = $_SESSION['nama'];
$jenis = $_POST['jenis'];
$spesifikasi = $_POST['spesifikasi'];
$deskripsi = $_POST['deskripsi'];


if (isset($_POST['simpan'])) {
    if (empty($spesifikasi && $deskripsi) != true) {
        $sql = "INSERT INTO request (userId, nama, jenis, request, alasan)
             values ('" . $username . "','" . $nama . "','" . $jenis . "','" . $spesifikasi . "','" . $deskripsi . "')";
        $a = $koneksi->query($sql);
        if ($a === true) {
            // $sukses = "Berhasil Menyimpan Data";
            echo "<script>alert('Berhasil Mengirim Permintaan!');</script>";
            header("refresh:2;url=tambahan.php");
        } else {
            echo "<script>alert('Gagal Mengirim Permintaan!');</script>";
            // $error
            header("refresh:2;url=tambahan.php");
        }
    } else {
        echo "<script>alert('Ada Input yang Kosong!');</script>";
        echo "<script>location('tambahan.php?status=gagal');</script>";
    }
} else {
    //  echo "<script>alert('Gagal Mengirim Pengaduan!');</script>";
    echo "<script>location('tambahan.php');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Permintaan Pelayanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>
        h1 {
            margin-top: 80px;
            text-align: center;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
        .layanan:hover>.dropdown-menu {
            display: block;
        }

        button {
            background-color: #2d2d44;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #fa736b;
        }

        .navbar-brand {
            font-weight: bold;
            color: #cdc2ae;
        }
        .kinerja {
            width: 80%;
        }
    </style>
</head>

<body>
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg navbar-light shadow-lg fixed-top" style="background-color: #68A7AD;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../home.php">S I L A D U</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../home.php">Home</a>
                    </li>
                    <li class="nav-item layanan">
                        <a class="nav-link" href="../petugas/aturan_layanan.php" aria-current="page">Layanan</a>
                    </li>
                </ul>
                <span class="navbar-profile">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php $username = $_SESSION['username'];
                                echo "$username"; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </span>
            </div>
        </div>
    </nav>

    <div class="container-fluid kinerja">
    <h1 class="pt-5">Permintaan Pelayanan</h1>
        <!-- <div class="container "> -->
        <div class="card-wrap mt-5">
            <div class="card request-form">
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        Permintaan ini bersifat <a class="text-body">tidak langsung</a>. Maksudnya, permintaan yang diajukan tidak dapat langsung menjadi opsi tambahan, karena harus diproses dahulu oleh petugas
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                        $a = mysqli_query($koneksi, "select * from user where username='$_SESSION[username]'");
                        $tampil = mysqli_fetch_array($a);
                        ?>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-start">Username</label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" name="username" value="<?= $tampil['nama'] ?>" disabled>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-start">Pelayanan</label>
                            <div class="col-sm-9 ">
                                <input type="radio" name="jenis" value="Pengaduan"> Pengaduan
                                <input type="radio" name="jenis" value="Administrasi"> Administrasi
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-start">Permintaan</label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" name="spesifikasi">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label text-start">Alasan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="deskripsi" placeholder="Tulis alasanmu max 100 kata"></textarea>
                            </div>
                        </div>
                        <div class="button-align text-end">
                            <button type="submit" name="simpan" class="btn btn-success">SIMPAN</button>
                            <button type="reset" name="reset" class="btn btn-danger">RESET</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- </div> -->
    </div>
    <br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>