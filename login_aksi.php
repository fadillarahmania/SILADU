<?php
error_reporting(0);

    include 'koneksi.php';
    session_start();
    $username = $_POST['username'];
    $psw = md5($_POST['psw']);

    $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND `password`='$psw'");
    $cek = mysqli_num_rows($sql);

        if ($cek > 0) {
            $data = mysqli_fetch_assoc($sql);
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];
                header("location:home.php");

        }else {
            header("location:login.php?alert=gagal");
        }
?>