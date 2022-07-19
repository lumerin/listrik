<?php 
	session_start();
	error_reporting(0);
	include 'config/koneksi.php';
	if (($_SESSION['username'] != "") && ($_SESSION['hak_akses'] != "")) {
		if ($_SESSION['hak_akses'] == "Admin") {
			$sql = mysql_query("SELECT * FROM tbl_admin WHERE id_admin = '$_SESSION[username]'");
				$data = mysql_fetch_array($sql);
			echo "<script>alert('Selamat datang $data[1] !');document.location.href='admin/index.php?menu=home'</script>";
		} elseif ($_SESSION['hak_akses'] == "Pelanggan") {
			$sql = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_SESSION[username]'");
				$data = mysql_fetch_array($sql);
			echo "<script>alert('Selamat Datang $data[2] !');document.location.href='pelanggan/index.php?menu=home'</script>";
		}
	} else {

	if (isset($_POST['login'])) {
		if (empty($_POST['username'] || $_POST['password'] || $_POST['hak_akses'])) {
			echo "<script>alert('Isi Field yang Kosong Terlebih Dahulu !')</script>";
		} else {
			if ($_POST['hak_akses'] == "Admin") {
				$sql = mysql_query("SELECT * FROM tbl_admin WHERE id_admin = '$_POST[username]' AND password = '$_POST[password]'");
				$data = mysql_fetch_array($sql);
				$halaman = "admin/index.php?menu=home";
				$notif = "Selamat Datang $data[1] !";
			} elseif ($_POST['hak_akses'] == "Pelanggan") {
				$sql = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[username]' AND password = '$_POST[password]'");
				$data = mysql_fetch_array($sql);
				$notif = "Selamat Datang $data[2] !";
				$halaman = "pelanggan/index.php?menu=home";
			}

			$cek = mysql_num_rows($sql);
			if ($cek > 0) {
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['hak_akses'] = $_POST['hak_akses'];
				echo "<script>alert('$notif');document.location.href='$halaman'</script>";
			} else {
				echo "<script>alert('Username atau Password Salah !')</script>";
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="asset/Fonts/open-iconic-master/font/css/open-iconic.min.css">
	<link rel="stylesheet" href="asset/Fonts/open-iconic-master/font/css/open-iconic-bootstrap.min.css">
</head>
<body style="background-image: url('foto/background/4.jpg');background-size: 100%">
	<form method="post">
		<div class="row justify-content-md-center">
			<div class="col-md-3 align-items-center" style="margin-top: 7%;background-color: transparent;">
				<div class="form-group">
					<center class="font-weight-bold" style="font-size: 45px"><span class="oi oi-person"></span> Login</center>
				</div>
				<div class="form-group">
					<label style="font-size: 25px">Username</label>
					<input type="text" class="form-control" name="username" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 32))" placeholder="Username" required>
				</div>
				<div class="form-group">
					<label style="font-size: 25px">Password</label>
					<input type="password" class="form-control" name="password" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 32))" placeholder="Password" required>
				</div>
				<div class="form-group">
					<label style="font-size: 25px">Hak Akses</label>
					<select class="form-control" name="hak_akses">
						<option selected disabled>--Silahkan pilih hak akses--</option>
						<option value="Admin">Admin</option>
						<option value="Pelanggan">Pelanggan</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-outline-primary" name="login"> <span class="oi oi-account-login"></span> Login</button>
				</div>
			</div>
		</div>
	</form>
</body>
<script src="asset/js/jquery-3.3.1.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/bootstrap.js"></script>
</html>
<?php } ?>