<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Multi User</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>
        body {
            background: linear-gradient(to right, #33ccff 0%, #ff99cc 100%);
            background-size: auto;
            background-repeat: repeat;
        }

        .form-container {
            font-family: 'Poppins', sans-serif;
            height: 100%;
            display: flex;
            justify-content: center;
        }

        .login-form {
            width: 400px;
            height: 500px;
            padding: 20px;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.3);
            /* background-color: #9edcf9 !important; */
            border-radius: 10px !important;
        }

        .card-title {
            font-weight: 900;
            padding-top: 20px;
        }

        h2 {
            color: darkslategray;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['alert'])) {
        if ($_GET['alert'] == "gagal") {
            echo "<p>Maaf! username & password salah</p>";
        } elseif ($_GET['alert'] == "belum_login") {
            echo "<p>Anda Harus Login terlebih dahulu!</p>";
        } elseif ($_GET['alert'] == "logout") {
            echo "<p>Anda telah logout!</p>";
        }
    }
    ?>
    <div class="form-container mt-4">
        <div class="card login-form">
            <div class="card-body">
                <h2 class="card-title text-center">LOGIN SILADU</h3>
            </div>
            <div class="card-text">
                <form action="login_aksi.php" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control" placeholder="Sesuai KTP/KK" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-text"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control" placeholder="Masukkan Password Anda!" name="psw">
                        </div>
                    </div>
                    <br>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">MASUK</button>
                        <button type="reset" class="btn btn-danger">RESET</button>
                    </div>
                </form>
            </div>
            <br>
            <p>Belum Punya Akun? Klik <a href="register.php">disini</a></p>
        </div>
    </div>

</body>

</html>