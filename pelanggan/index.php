<?php 
	session_start();
	error_reporting(0);
	include '../config/koneksi.php';

	if (empty($_SESSION['username'] || $_SESSION['hak_akses'])) {
		echo "<script>alert('Silahkan login terlebih dahulu !');document.location.href='../'</script>";
	} elseif ($_SESSION['hak_akses'] != "Pelanggan") {
		$_SESSION['username'] = "";
		$_SESSION['hak_akses'] = "";
		echo "<script>alert('Silahkan login dengan hak akses yang benar !');document.location.href='../'</script>";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pelanggan</title>
	<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="../asset/css/datatables.min.css">
	<link rel="stylesheet" href="../asset/octicons/lib/octicons.css">
	<link rel="stylesheet" href="../asset/Fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="../asset/Fonts/open-iconic-master/font/css/open-iconic.min.css">
	<link rel="stylesheet" href="../asset/Fonts/open-iconic-master/font/css/open-iconic-bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="background-image: url('../foto/background/3.jpg');background-size: 100%">
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar navbar-brand" href="#">PLN</a>
			
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="?menu=home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=tagihan">Tagihan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=pembayaran">pembayaran</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=laporan_pembayaran">Laporan Pembayaran</a>
					</li>
				</ul>
				<ul class="navbar-nav navbar-right">
					<li class="navbar-item">
						<a class="nav-link" onclick="return confirm('Yakin ingin keluar ?')" href="?menu=logout">Logout</a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container col-md-12">
			<?php 
				switch ($_GET['menu']) {
					case 'home':
						include 'home.php';
						break;
					case 'tagihan':
						include 'tagihan.php';
						break;
					
					case 'pembayaran':
						include 'pembayaran.php';
						break;

					case 'bayar':
						include 'bayar.php';
						break;

					case 'laporan_pembayaran':
						include 'laporan_pembayaran.php';
						break;

					case 'logout':
						unset($_SESSION['username']);
						unset($_SESSION['hak_akses']);
						echo "<script>alert('Anda telah keluar !');document.location.href='../'</script>";
						break;
				}
			 ?>
		</div>
</body>
<script src="../asset/js/jquery-3.3.1.min.js"></script>
<script src="../asset/js/bootstrap.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/bootstrap.bundle.min.js"></script>
<script src="../asset/datatables.min.js"></script>
<script src="../asset/js/util.js"></script>
<script>
	$(document).ready(function(){
		$('#data').DataTable({
			responsive: true
		});
	});
</script>
</html>