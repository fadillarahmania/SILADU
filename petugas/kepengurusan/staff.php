<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login, klik <a href=\"../../index.php\">disini</a> untuk login");
} else {
    $username = $_SESSION['username'];
    $nama = $_SESSION['nama'];
    $level = $_SESSION['level'];
}

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM kepengurusan WHERE id='$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses!');
            location='staff.php';
            </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INPUT DATA PETUGAS</title>
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

        .staff {
            width: 90%;
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
    </style>
</head>

<body>
    <!-- navbar -->
   <nav class="navbar navbar-expand-lg navbar-light shadow-lg fixed-top" style="background-color: #68A7AD;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../home.php">S I L A D U</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../home.php">Home</a>
                    </li>
                    <li class="nav-item layanan">
                        <a class="nav-link" href="../../petugas/aturan_layanan.php" aria-current="page">Layanan</a>
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
                                <li><a class="dropdown-item" href="../../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </span>
            </div>
        </div>
    </nav>

    <?php if ($_SESSION['level'] == 'petugas' || $_SESSION['level'] == 'admin') { ?>

        <div class="container-fluid staff pt-5">
            <div class="card-wrap mt-5">
                <div class="card pengaduan-form">
                    <div class="card-header form-peng">
                        <h2 class="card-title text-center" >INPUT DATA STAFF</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="proses.php" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Kode pengurus</label>
                                <div class="col-sm-9 ">
                                    <input type="number" class="form-control" name="id">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Nama Lengkap</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">NIP</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control" name="nip" minlength="18" maxlength="18">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="formFileMultiple" class="col-sm-3 col-form-label text-start">Foto</label>
                                <div class="col-sm-9 ">
                                <!-- <img src="staff/<?php echo $tampil['foto'] ?>" width="100" height="100"> -->
                                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Jabatan</label>
                                <div class="col-sm-9 ">
                                    <input type="text" class="form-control" name="jabatan">
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
        </div>
    <?php } ?>

    <div class="container-fluid staff">
        <div class="card-wrap mt-4">
            <!-- <div class="card tabel-form"> -->
            <!-- <div class="card-header"> -->
            <h3 class="card-title text-center mb-3" style= "padding-top: 90px;" >List Staff Desa Kenanten</h3>
            <!-- </div> -->
            <!-- <div class="card-body"> -->
            <table class="table table-bordered table-striped">
                <tr class="text-center">
                    <th scope="col">No.</th>
                    <!-- <th>Tanggal Input Data</th> -->
                    <th scope="col">ID</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                </tr>
                <?php
                include "../../koneksi.php";
                $no = 1;
                $sql = "SELECT * FROM kepengurusan ORDER BY id ASC";
                $result = mysqli_query($koneksi, $sql);

                if (!$result) {
                    die("Query Error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
                }
                while ($tampil = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $tampil['id'] ?></td>
                        <td><?= $tampil['nip'] ?></td>
                        <td><img src="staff/<?= $tampil['foto'] ?>" width="100" height="100"></td>
                        <td><?= $tampil['nama'] ?></td>
                        <td><?= $tampil['jabatan'] ?></td>
                        <?php if ($_SESSION['level'] == "warga" || $_SESSION['level'] == "admin") { ?>
                            <td class="text-center">
                                <a href="staff.php?hal=hapus&id=<?= $tampil['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
            <!-- </div> -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>