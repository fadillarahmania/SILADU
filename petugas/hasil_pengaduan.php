<?php
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if (!isset($_SESSION['username'])) {
    die("Anda belum login, klik <a href=\"../index.php\">disini</a> untuk login");
} else {
    $username = $_SESSION['username'];
}

// $kode = $_GET['id'];
// $petugas = $_SESSION['nama'];
$pengId = $_POST['pengId'];
$tanggapan = $_POST['tanggapan'];
$nama = $_POST['nama'];
$petugas = $_SESSION['nama'];
$file_name = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
$direktori = "hasil_pengaduan/";
$linkberkas = $direktori . $file_name;


if (isset($_POST['simpan'])) {
    if (empty($pengId && $nama && $tanggapan && $file_name) != true) {

        $sql = "INSERT INTO hasil_pengaduan (pengaduanId, nama, deskripsi, file,tanggal, petugas)
             values ('" . $pengId . "','" . $nama . "','" . $tanggapan . "','" . $file_name . "',NOW(),'" . $petugas . "')";
        $a = $koneksi->query($sql);
        if ($a === true) {
            move_uploaded_file($file_tmp, $linkberkas);
            echo "<script>alert('Berhasil Mengirim Hasil Pengaduan!');</script>";
            header("refresh:2;url=hasil_pengaduan.php");
            // echo "<script>
            // alert('Hapus Data dari pengaduan Sukses!');
            // location='hasil_pengaduan.php';
            // </script>";

        } else {
            echo "<script>alert('Gagal Mengirim Aturan!');</script>";
            // echo "<script>location('aturan_layanan.php?status=gagal');</script>";
            header("refresh:2;url=hasil_pengaduan.php");
        }
    } else {
        echo "<script>alert('Ada Input yang Kosong!');</script>";
        echo "<script>history.back();</script>";
        // echo "<script>location('aturan_layanan.php?status=gagal');</script>";
    }
} else {
    // echo "<script>alert('Isi Form / Gagal Mengirim Pengaduan!');</script>";
    echo "<script>location('hasil_pengaduan.php');</script>";
}

// tombol edit tabel
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM hasil_pengaduan WHERE id='$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses!');
            location='hasil_pengaduan.php';
            </script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HASIL LAYANAN</title>
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

        .hasil {
            width: 95%;
        }

        .form-hasil {
            width: 85%;
            text-align: left;
        }
        .text-start {
            font-weight: bold;
        }

        .aturan {
            width: 90%;
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

        .administrasi {
            width: 95%;
        }

        .form-peng {
            background-color: #ECE5C7;
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
                        <a class="nav-link" href="aturan_layanan.php" aria-current="page">Layanan</a>
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
    <h1> Hasil Pelaporan Pelayanan</h1>
    <div class="container-fluid hasil">
        <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
            <center>
                <div class="card-wrap mt-5 form-hasil">
                    <div class="card hasil-form">
                        <div class="card-header">
                            <h2 class="card-title text-center">INPUT TANGGAPAN PENGADUAN</h2>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label text-start">ID pengaduan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pengId" placeholder="Harus Sesuai dengan Kode Pengaduan">
                                        <label>*pastikan id sesuai dengan pengaduan <a href="../pengguna/pengaduan.php">disini</a></label>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label text-start">Nama Pemohon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama" placeholder="Harus Sesuai dengan Kode Pengaduan">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label text-start">Tanggapan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="tanggapan"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="formFileMultiple" class="col-sm-3 col-form-label text-start">File</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="file" name="file" id="formFileMultiple" accept="application/pdf">
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
            </center>
        <?php } ?>

        <div class="card-wrap mt-4" >
            <!-- <div class="card tabel-form"> -->
                <!-- <div class="card-header"> -->
                    <!-- <h3 class="card-title text-center">Hasil Pengaduan</h3> -->
                <!-- </div> -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Kode Pengaduan</th>
                            <th>Nama</th>
                            <th>Tanggapan</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th>Petugas</th>
                            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                        <?php
                        $no = 1;
                        if ($_SESSION['level'] == "petugas" || $_SESSION['level'] == "admin") {
                            $a = mysqli_query($koneksi, "SELECT * FROM hasil_pengaduan");
                        } elseif ($_SESSION['level'] == "warga") {
                            $a = mysqli_query($koneksi, "SELECT * FROM hasil_pengaduan WHERE nama= '$_SESSION[nama]' ");
                        }
                        // $a = mysqli_query($koneksi, "SELECT hasil_pengaduan.pengaduanId,pengaduan.userId,pengaduan.nama, hasil_pengaduan.deskripsi, hasil_pengaduan.file, hasil_pengaduan.tanggal, hasil_pengaduan.petugas
                        // FROM hasil_pengaduan
                        // INNER JOIN pengaduan
                        // ON hasil_pengaduan.pengaduanId=pengaduan.id
                        // WHERE pengaduan.nama = $_SESSION[nama] ");
                        while ($tampil = mysqli_fetch_array($a)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <!-- <td><?= $tampil['id'] ?></td> -->
                                <td><?= $tampil['pengaduanId'] ?></td>
                                <td><?= $tampil['nama'] ?></td>
                                <td><?= $tampil['deskripsi'] ?></td>
                                <td><a href="downloadfile.php?hasil=<?= $tampil['file']; ?>">Hasil</a></td>
                                <td><?= $tampil['tanggal'] ?></td>
                                <td><?= $tampil['petugas'] ?></td>
                                <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
                                    <td class="text-center">
                                        <a href="hasil_pengaduan.php?hal=hapus&id=<?= $tampil['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" name="hapus" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            <!-- </div> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>