<?Php
session_start();
include "../koneksi.php";

if (!empty($_GET['peng'])) {
    $fileName = basename($_GET['peng']);
    $filePath = "../pengaduan/".$fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: Attachment; fileName=$fileName");
        header("Content-Type: Application/zip");
        header("Content-Transfer-Encoding: binary");

        //read file
        readfile($filePath);
        exit;
    }else {
        echo "file not exist";
    }
}elseif (!empty($_GET['adm'])) {
    $fileName = basename($_GET['adm']);
    $filePath = "../administrasi/".$fileName;

    if (!empty($fileName) && file_exists($filePath)) {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: Attachment; fileName=$fileName");
        header("Content-Type: Application/zip");
        header("Content-Transfer-Encoding: binary");

        //read file
        readfile($filePath);
        exit;
    }else {
        echo "file not exist";
    }
}

// // Tentukan folder file yang boleh di download
// $folder = "template/";
// // Lalu cek menggunakan fungsi file_exist
// if (!file_exists($folder.$_GET['url'])) {
//   echo "<h1>Access forbidden!</h1>
//       <p> Anda tidak diperbolehkan mendownload file ini.</p>";
//   exit;
// }

// // Apabila mendownload file di folder files
// else {
//   header("Content-Type: octet/stream");
//   header("Content-Disposition: attachment;
//   filename=\"".$_GET['url']."\"");
//   $fp = fopen($folder.$_GET['url'], "r");
//   $data = fread($fp, filesize($folder.$_GET['url']));
//   fclose($fp);
//   print $data;
// }

// if (isset($_GET['url'])) {
//     $filename = $_GET['url'];

//     $back_dir = "template/";
//     $file = $back_dir.$_GET['url'];

//     if (file_exists($file)) {
//         header('Content-Description: File Transfer');
//         header('Content-Type: application/octet-stream');
//         header('Content-Disposition: attachment; url="'.basename($file).'"');
//         header('Content-Transfer-Encoding: binary');
//         header('Expires: 0');
//         header('Cache-Control: private');
//         header('Pragma: private');
//         header('Content-Length: ' . filesize($file));
//         ob_clean();
//         flush();
//         readfile($file);
//         exit;
//     }else{
//         echo "<script>alert('Oops!File tidak ditemukan');</script>";
//         header("location: aturan_layanan.php");
//     }
// }
// $file = $_GET['url'];

// if (file_exists($file)) {
//     header('Content-Description: File Transfer');
//     header('Content-Type: application/octet-stream');
//     header('Content-Disposition: attachment; url="'.basename($file).'"');
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate');
//     header('Pragma: public');
//     header('Content-Length: ' . filesize($file));
//     readfile($file);
//     exit;
// }
?>