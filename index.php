<html>

<head>
	<title>SILADU</title>
	<!-- <link rel="stylesheet" href="style.css"> -->
	<style>
		body {
			background: linear-gradient(to right, #33ccff 0%, #ff99cc 100%);
			background-size: auto;
			background-repeat: repeat;
		}
		table {
			font-family: 'Poppins', sans-serif;
			border-collapse: collapse;
		}

		table,
		th,
		td {
			border: 1px solid #9edcf9;
		}

		button {
			background-color: #B40404;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 15px;
		}

		.logo {
			width: 300px;
			/* height: 200px; */
		}

		.jargon {
			font-size: 20px;
		}

		button:hover {
			background-color: #fa736b;
		}

		.perintah {
			/* font-size: 14px; */
			text-align: center;
		}
	</style>
	<link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
	<center><br><br>
	<div class="container">
	<table width=90% height=90%>
			<tr>
				<td bgcolor=#9edcf9><br>
					<h1 align=center>Sistem Informasi Pelayanan dan Pengaduan Masyarakat</h1>
				</td>
			</tr>
			<tr>
				<td bgcolor="#e1edf4">
					<marquee behavior="alternate">Selamat Datang di SILADU</marquee>
				</td>
			</tr>
			<tr>
				<td bgcolor=#fff><br>
					<p align=center class="jargon"><img src="image/cover.jpg" class="logo"><br><br>Sampaikan Layanan dan Pengaduan yang anda inginkan!<br>
					<p class="perintah">Silahkan login jika Anda sudah memiliki akun</p>
					</p>
					<p align=center><a href="login.php"><button>Login</button></a></p>
					<p class="perintah">Belum punya akun? Silahkan mendaftar disini</p>
					<p align=center><a href="register.php"><button>Register</button></a></p><br>
				</td>
			</tr>
		</table>
	</div>
	</center><br>
</body>

</html>