<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['psw'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$tlp = $_POST['tlp'];
$level = $_POST['level'];
$nip = $_POST['nip'];

if (empty($username && $password && $nama && $email && $alamat && $tlp && $level) != true) {
    $cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    $cek_login = mysqli_num_rows($cek_user);
    if ($cek_login > 0) {
        echo "<script>
            alert('username milik orang lain. Pakai username lain!');
            </script>";
    } else {
        $newpsw = md5($password);
        $sql = "INSERT INTO user VALUES ('" . $username . "','" . $newpsw . "','" . $nama . "','" . $email . "','" . $alamat . "','" . $tlp . "','" . $level . "','" . $nip . "')";
        $a = $koneksi->query($sql);
        if ($a === true) { ?>
            <script>
                alert('Anda sukses registrasi');
                location.replace('login.php');
            </script><?php
                    } else {
                        echo "<script>alert('Error memasukkan data!');</script>";
                        echo "<script>history.back();</script>";
                    }
                }
} else { ?>
    <script>
        alert('Ulangi, Ada Input yang Kosong');
        history.back();
    </script>
<?php
    }
?>