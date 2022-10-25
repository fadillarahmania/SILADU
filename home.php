<?php
include "koneksi.php";
if (empty($_SESSION))
  session_start();

if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>DASHBOARD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    .pict {
      width: 200px;
    }

    .tentang {
      width: 500px;
    }

    .cek {
      width: 300px;
    }

    /* .dropdown-item:hover {
        color: white;
        background-color: #dc3545;
    } */
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
      <a class="navbar-brand" href="home.php">S I L A D U</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item layanan">
            <a class="nav-link" href="#" aria-current="page">Layanan</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="petugas/aturan_layanan.php">
                <?php if ($_SESSION['level'] == 'petugas' || $_SESSION['level'] == 'admin') { ?>
                  Input Aturan Layanan
                <?php } else{?>
                  Aturan Layanan
                <?php }?>
              </a></li>
              <li><a class="dropdown-item" href="petugas/layanan.php">Spesifikasi Layanan</a></li>
            </ul>
          </li>
          <li class="nav-item layanan">
            <a class="nav-link" href="petugas/kepengurusan/staff.php">Kepengurusan</a>
          </li>
          <li class="nav-item feedback">
            <a class="nav-link" href="#tentang">Tentang</a>
          </li>
          <li class="nav-item about">
            <a class="nav-link" href="pengguna/feedback.php">Feedback</a>
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
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </span>
      </div>
    </div>
  </nav>
  <!-- banner -->
  <div class="container-fluid banner">
    <div class="container text-center">
      <h4 class="display-6">Selamat Datang di<br>Sistem Informasi Pelayanan dan Pengaduan Masyarakat <strong>Desa Kenanten</strong> </h4>
    </div>
  </div>
  <!-- layanan -->
  <div class="container-fluid layanan pt-5 pb-5">
    <div class="container text-center">
      <?php $level = $_SESSION['level'];
      echo "Hai! kamu login sebagai $level"; ?><br><br>
      <h2 class="display-6 fw-bold" id="layanan">Layanan</h2>
      <p>Layanan yang diberikan pada <strong>SILADU</strong> berupa pelayanan untuk pengaduan dan pelayanan untuk pengajuan administrasi. Warga juga dapat mengajukan permintaan terkait dengan pelayanan yang disediakan. Diharapkan dengan adanya pengelolaan pelayanan ini, warga menjadi terbantu dan terbuka untuk menyuarakan aspirasinya untuk Desa Kenanten lebih maju.</p>
      <div class="row pt-4">
        <div class="col-md-4">
          <img src="image/pengaduan.png" class="pict">
          <h3 class="mt-3">Laporan Pengaduan</h3>
          <p>Laporkan keresahanmu terkait dengan lingkungan sekitar! Pastikan sertakan bukti yang konkrit, aktual, dan sesuai peraturan yang ada serta pastikan biodatamu benar. Maka pengaduanmu akan segera diproses oleh petugas.</p>
          <p><a href="pengguna/pengaduan.php"><button>Laporkan Aduanmu</button></a></p>
        </div>
        <div class="col-md-4">
          <img src="image/layanan.png" class="pict">
          <h3 class="mt-3">Pelayanan Administrasi</h3>
          <p>Ajukan permintaanmu terkait surat keterangan, dan semacamnya. Hanya dengan mengisi persyaratan yang diminta, dan pastikan biodatamu benar. Maka permintaan administrasimu akan segera diproses oleh petugas.</p>
          <p><a href="pengguna/administrasi.php"><button>Ajukan Administrasi</button></a></p>
        </div>
        <div class="col-md-4">
          <img src="image/permintaan3.png" class="pict">
          <h3 class="mt-3">Permintaan Pelayanan</h3>
          <p>Pelayanan yang kami berikan adalah sesuai dengan permintaan masyarakat. Jadi jika ada pelayanan yang anda inginkan tapi belum tersedia? Klik tombol dibawah ini dan isi form yang ada agar kami dapat segera memproses permintaanmu</p>
          <p><a href="pengguna/tambahan.php"><button>Tambah Pelayanan</button></a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- <hr /> -->
  <p class="text-center">●●●</p>

  <div class="container-fluid hasil">
    <div class="container text-center">
      <div class="pt-4 text-center">
        <h4 class="display-6 fw-bold" id="cek">Cek Hasil Pelayanan</h4>
        <img src="image/hasillayanan.png" class="cek">
        <p>
          <a href="petugas/hasil_pengaduan.php"><button>CEK PENGADUAN</button></a>
          <a href="petugas/hasil_administrasi.php"><button>CEK ADMINISTRASI</button></a>
        </p>

      </div>
    </div>
  </div>
  <br>
  <!-- <hr> -->
  <p class="text-center">●●●</p>
  <div class="container-fluid pt-5 pb-5" id="tentang">
    <div class="container">
      <h2 class="display-6 text-center fw-bold">Tentang</h2>
      <p class="text-center fw-bold">Sistem Informasi Pelayanan dan Pengaduan Masyarakat</p>
      <div class="clearfix pt5">
        <img src="image/aboutus.jpg" class="col-md-6 float-md-end mb-3 tentang crop-image" />
        <p>
          Sistem Informasi Pelayanan dan Pengaduan Masyarakat atau disingkat <strong>SILADU</strong> merupakan wadah bagi masyarakat untuk menyampaikan aspirasi dan permintaannya terkait dengan pengaduan masyarakat dan pelayanan administrasi. <br>
          <br> Tujuan adanya sistem informasi ini adalah agar warga Desa kenanten bisa terbantu dalam pengurusan pengaduan dan administrasi sehingga tidak menggangu mobilitas masyarakat <br>
          <br> Adapun pada laman ini, petugas desa juga terbantu dalam mengidentifikasi identitas warga, agar dalam pelayanannya dapat selesai dalam waktu yang cepat
        </p>
      </div>
    </div>
  </div>


  <footer class="bg-dark text-white pt-4 pb-4">
    <div class="container text-center text-md-start">
      <div class="row text-center text-md-start">
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold text-info">SILADU</h5>
          <p>Sampaikan Laporanmu, Kami akan Melayanimu</p>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold text-info">Fitur</h5>
          <p>
            <a href="#" class="text-white" style="text-decoration:none;">Home</a>
          </p>
          <p>
            <a href="petugas/aturan_layanan.php" class="text-white" style="text-decoration:none;">Peraturan</a>
          </p>
          <p>
            <a href="" class="text-white" style="text-decoration:none;">Kepengurusan</a>
          </p>
          <p>
            <a href="#" class="text-white" style="text-decoration:none;">Tentang</a>
          </p>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold text-info">Jenis Layanan</h5>
          <p>
            <a href="#" class="text-white" style="text-decoration:none;">Laporan Pengaduan</a>
          </p>
          <p>
            <a href="#" class="text-white" style="text-decoration:none;">Pengajuan Administrasi</a>
          </p>
          <p>
            <a href="#" class="text-white" style="text-decoration:none;">Penilaian Kinerja</a>
          </p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold text-info">Hubungi Kami</h5>
          <p>
            <i class="fas fa-home mr-3"></i> Jln. Panda, Kab. Mojokerto
          </p>
          <p>
            <i class="fas fa-envelope mr-3"></i> siladu-kenanten@gmail.com
          </p>
          <p>
            <i class="fas fa-phone mr-3"></i> (+62) 857 6899 5048
          </p>
          <p>
            <i class="fas fa-print mr-3"></i> (0321) 3851193
          </p>
        </div>
        <hr class="mb-3">
        <div class="col-md-7 col-lg-8">
          <p>Copyright ©2022 All-Rights Reserved by:
            <strong class="text-warning">Fadilla Rahmania (200605110028)</strong>
          </p>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>