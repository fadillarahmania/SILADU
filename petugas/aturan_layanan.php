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
$nama = $_SESSION['nama'];
$jenis = $_POST['jenis'];
$deskripsi = $_POST['deskripsi'];
$file_name = $_FILES['data']['name'];
$file_tmp = $_FILES['data']['tmp_name'];
$direktori = "template/";
$linkberkas = $direktori . $file_name;


if (isset($_POST['simpan'])) {
    if (empty($jenis && $deskripsi && $file_name) != true) {
        if ($_GET['hal'] == "edit") {
            $query = "UPDATE aturan_layanan SET
             id_layanan = '$jenis',
             aturan = '$deskripsi',
             template_data = '$file_name',
             petugas = '$nama'
             WHERE aturan_layanan.id = '$kode'";
            $edit = mysqli_query($koneksi, $query) or die("Error in query: $query");
            $terupload = move_uploaded_file($file_tmp, $linkberkas);

            if ($edit && $terupload == 1) {
                echo "<script>alert('Berhasil Memperbarui Pengaduan!');</script>";
                // echo "<script>location.replace('aturan_layanan.php');</script>";
                header("refresh:2;url=aturan_layanan.php");
            } else {
                echo "<script>alert('Edit Data Gagal!');</script>";
                // echo "<script>location.replace('aturan_layanan.php');</script>";
                header("refresh:2;url=aturan_layanan.php");
            }
        } else {

            $sql = "INSERT INTO aturan_layanan (id_layanan, aturan, template_data,petugas)
             values ('" . $jenis . "','" . $deskripsi . "','" . $file_name . "','" . $nama . "')";
            $a = $koneksi->query($sql);
            if ($a === true) {
                move_uploaded_file($file_tmp, $linkberkas);
                echo "<script>alert('Berhasil Mengirim Aturan Layanan!');</script>";
                // echo "<script>location('aturan_layanan.php?status=sukses');</script>";
                header("refresh:2;url=aturan_layanan.php");
            } else {
                echo "<script>alert('Gagal Mengirim Aturan!');</script>";
                // echo "<script>location('aturan_layanan.php?status=gagal');</script>";
                header("refresh:2;url=aturan_layanan.php");
            }
        }
    } else {
        echo "<script>alert('Ada Input yang Kosong!');</script>";
        echo "<script>history.back();</script>";
        // echo "<script>location('aturan_layanan.php?status=gagal');</script>";
    }
} else {
    // echo "<script>alert('Isi Form / Gagal Mengirim Pengaduan!');</script>";
    echo "<script>location('aturan_layanan.php');</script>";
}

// tombol edit tabel
if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $b = mysqli_query($koneksi, "SELECT * FROM aturan_layanan where id='$_GET[id]'");
        $data = mysqli_fetch_array($b);
        if ($data) {
            $vjenis = $data['id_layanan'];
            $vdesk = $data['aturan'];
            $vdata = $data['template_data']['name'];
        }
    } elseif ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM aturan_layanan WHERE id='$_GET[id]'");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses!');
            location='aturan_layanan.php';
            </script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        h1 {
            margin-top: 80px;
            text-align: center;
        }

        body {
            font-family: 'Poppins', sans-serif;
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="aturan_layanan.php">Input Aturan Layanan</a></li>
                        </ul>
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
    <h1>Syarat dan Ketentuan Terkait Pelayanan Pada <STRong>SILADU</STRong> </h1>
    <div class="container-fluid aturan">
        <?php
        $a = mysqli_query($koneksi, "select * from user where username='$_SESSION[username]'");
        $tampil = mysqli_fetch_array($a); ?>

        <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
            <div class="card-wrap mt-5">
                <div class="card aturan-form">
                    <div class="card-header form-aturan" style="background-color: #6D8B74;">
                        <h2 class="card-title text-center">ATURAN PELAYANAN</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Pelayanan</label>
                                <div class="col-sm-9">
                                    <select name="jenis" value="<?= $vjenis ?>" class="form-control">
                                        <?php
                                        include "../koneksi.php";
                                        $a = "SELECT * FROM layanan";
                                        $b = mysqli_query($koneksi, $a);
                                        while ($c = $b->fetch_array()) { ?>
                                            <option value="<?php echo $c['id']; ?>"> <?php echo $c['spesifikasi']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-start">Aturan Dasar</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="deskripsi" value="<?= @$vdesk ?>" placeholder="Tulis detail pengaduanmu max 200 kata"><?= $vdesk ?></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="formFileMultiple" class="col-sm-3 col-form-label text-start">Template Data Dukung</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" name="data" value="<?= @$vdata ?>" id="formFileMultiple" accept="">
                                    <?php
                                    if ($_GET['hal'] == "edit") { ?>
                                        <label class="text-danger">Upload File terbaru untuk diperbarui</label>
                                    <?php } ?>
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
            <!-- <div class="card tabel-form"> -->
                <!-- <div class="card-header"> -->
                    <h3 class="card-title text-center">Daftar Persyaratan dan Format Data Pendukung</h3>
                <!-- </div> -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" >
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Pelayanan</th>
                            <th>Spesifikasi</th>
                            <th>S&K</th>
                            <th>Format Pendukung</th>
                            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') {?>
                            <th>Aksi</th>
                            <?php } ?>
                        </tr>
                        <?php
                        $no = 1;
                        $a = mysqli_query($koneksi, "SELECT aturan_layanan.id,layanan.jenis,spesifikasi,aturan,template_data FROM aturan_layanan
                                                INNER JOIN layanan ON aturan_layanan.id_layanan=layanan.id");
                        while ($tampil = mysqli_fetch_array($a)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $tampil['jenis'] ?></td>
                                <td><?= $tampil['spesifikasi'] ?></td>
                                <td><?= $tampil['aturan'] ?></td>
                                <td><a href="downloadfile.php?url=<?= $tampil['template_data']; ?>"><?php echo $tampil['template_data']; ?></a></td>
                                <!-- <td><?= $tampil['template_data'] ?></td> -->
                                <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') {?>
                                <td class="text-center">
                                    <a href="aturan_layanan.php?hal=edit&id=<?= $tampil['id'] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="aturan_layanan.php?hal=hapus&id=<?= $tampil['id'] ?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" name="hapus" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <?php } ?>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            <!-- </div> -->
        </div>
        <!-- <? ?> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>