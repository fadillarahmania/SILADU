<?php
include('../../koneksi.php');

$kode = $_POST['id'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$file_name = $_FILES['foto']['name'];
$direktori = "staff/";
// $linkberkas = $direktori . $file_name;
if (empty($kode && $nama && $nip && $jabatan && $file_name) != true) {
    $ekstensi_boleh = array('png', 'jpg');
    $x = explode('.', $file_name);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    $angka_acak = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $file_name;

    if (in_array($ekstensi, $ekstensi_boleh) === true) {
        move_uploaded_file($file_tmp, $direktori . $nama_gambar_baru);

        $query = "INSERT INTO kepengurusan (id, nip, foto, nama, jabatan)
                 values ('" . $kode . "','" . $nip . "','" . $nama_gambar_baru . "','" . $nama . "','" . $jabatan . "')";
        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error: " . mysqli_error($koneksi) . "-" . mysqli_error($koneksi));
        } else {
            echo "<script>alert('Berhasil Mengirim Aturan Layanan!');</script>";
            // header("location:inputstaff.php");
            echo "<script>location('staff.php');</script>";
        }
    } else {
        echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png');</script>";
        echo "<script>location('staff.php');</script>";
    }
} else {
    echo "<script>alert('Ada Input Kosong!');</script>";
    echo "<script>history.back()</script>";
}


?>
