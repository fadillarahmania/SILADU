<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" target="_blank" rel="noreferrer noopener"></script>
    <style>
        body {
            background: linear-gradient(to right, #33ccff 0%, #ff99cc 100%);
            background-size: auto;
            background-repeat: repeat;
        }
        .register-wrap {
            font-family: 'Poppins', sans-serif;
            height: 100%;
            display: flex;
            justify-content: center;
        }
        .register-form {
            /* background-color: #FEFBE7 !important; */
            padding: 20px;
            width: 500px;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.3);
        }
        .hidden{
        display: none;
        }
        .show{
            display: block;
        }
        .card-title {
            font-weight: 900;
            color: darkslategray;
        }
    </style>
</head>

<body>
    <!-- <center> -->
    <div class="register-wrap mt-4">
        <div class="card register-form">
            <div class="card-body">
                <h2 class="card-title text-center">REGISTER SILADU</h3>
            </div>
            <div class="card-text">
                <form action="register_aksi.php" method="post">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" maxlength="15">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="psw">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" placeholder="Sesuai KTP/KK">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="exampleFormControlInput1" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="name@gmail.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="alamat" placeholder="Sesuai KTP/KK"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">No. Tlp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tlp">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                            <fieldset>
                                <select name="level" id="level" class="level form-select">
                                    <option value="admin">Admin</option>
                                    <option value="warga" selected>Warga</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="hidden" id="pDetails">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">NIP</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nip"  minlength="18" maxlength="18">
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="pDetails2">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode" pattern="[F-J0-9]{7,7}">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">DAFTAR</button>
                        <button type="reset" class="btn btn-danger">RESET</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $('.level').change(function() {
                var responseID = $(this).val();
                if (responseID == "petugas"){
                    $('#pDetails2').removeClass("show");
                    $('#pDetails2').addClass("hidden");
                    $('#pDetails').removeClass("hidden");
                    $('#pDetails').addClass("show");
                }else if (responseID == "admin"){
                    $('#pDetails').removeClass("show");
                    $('#pDetails').addClass("hidden");
                    $('#pDetails2').removeClass("hidden");
                    $('#pDetails2').addClass("show");
                }else if (responseID == "warga"){
                    $('#pDetails').removeClass("show");
                    $('#pDetails').addClass("hidden");
                    $('#pDetails2').removeClass("show");
                    $('#pDetails2').addClass("hidden");
                }
                console.log(responseID);
            });
        </script>
        <!-- </center> -->
</body>

</html>