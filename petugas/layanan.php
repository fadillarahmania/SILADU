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
$layanan = $_POST['spesifikasi'];


if (isset($_POST['simpan'])) {
    if (empty($jenis && $layanan) != true) {
        $sql = "INSERT INTO layanan (jenis, spesifikasi)
             values ('" . $jenis . "','" . $layanan . "')";
        $a = $koneksi->query($sql);
        if ($a === true) {
            echo "<script>alert('Berhasil Mengirim Spesifikasi Layanan!');</script>";
            header("refresh:2;url=layanan.php");
            // echo "<script>location('layanan.php?status=sukses');</script>";
        } else {
            echo "<script>alert('Gagal Menginput Spesifikasi Layanan!');</script>";
            // echo "<script>location('layanan.php?status=gagal');</script>";
            header("refresh:2;url=administrasi.php");
        }
    } else {
        echo "<script>alert('Ada Input yang Kosong!');</script>";
        // echo "<script>location('layanan.php?status=gagal');</script>";
        header("refresh:2;url=layanan.php");
    }
} else {
    //  echo "<script>alert('Gagal Mengirim Pengaduan!');</script>";
    echo "<script>location('layanan.php');</script>";
}

// tombol edit tabel
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM layanan WHERE id='$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses!');
            location='layanan.php';
            </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Layanan</title>
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

        layanan:hover>.dropdown-menu {
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!-- <li><a class="dropdown-item" href="../petugas/aturan_layanan.php">Input Aturan Layanan</a></li>
                            <li><a class="dropdown-item" href="../petugas/layanan.php">Spesifikasi Layanan</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item layanan">
                        <a class="nav-link" href="../petugas/kepengurusan/staff.php">Kepengurusan</a>
                        <?php if ($_SESSION['level'] == "petugas" || $_SESSION['level'] == "admin") { ?>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../petugas/kepengurusan/inputstaff.php">Input Staff</a></li>
                            </ul>
                        <?php } ?>
                    </li>
                    <li class="nav-item about">
                        <a class="nav-link" href="../home.php/#tentang">Tentang</a>
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

    <h1>SPESIFIKASI PELAYANAN PADA <STROng>SILADU</STROng></h1>
    <div class="container-fluid layanan">
        <!-- <div class="container "> -->
        <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
            <div class="card-wrap mt-5">
                <div class="card layanan-form">
                    <div class="card-header form-layanan" style="background-color: #ECB390;">
                        <h2 class="card-title text-center">FORM INPUT</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Jenis Layanan</label>
                                <div class="col-sm-9 ">
                                    <input type="radio" name="jenis" value="Pengaduan"> Pengaduan
                                    <input type="radio" name="jenis" value="Administrasi"> Administrasi
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Spesifikasi Layanan</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control" name="spesifikasi">
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
        <?php } ?>
        <div class="card-wrap mt-4">
            <div class="card tabel-form">
                <div class="card-header" style="background-color: #DF7861;">
                    <h3 class="card-title text-center">Datar Layanan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Jenis Pengaduan</th>
                            <th>Spesifikasi Layanan</th>
                            <!-- <th>Peraturan</th> -->
                            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                        <?php
                        $no = 1;
                        $a = mysqli_query($koneksi, "SELECT * FROM layanan");
                        while ($tampil = mysqli_fetch_array($a)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $tampil['jenis'] ?></td>
                                <td><?= $tampil['spesifikasi'] ?></td>
                                <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
                                    <td class="text-center">
                                        <a href="layanan.php?hal=hapus&id=<?= $tampil['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
    <br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>