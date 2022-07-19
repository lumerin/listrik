<?php 
	session_start();
	error_reporting(0);
	include '../config/koneksi.php';

	if (empty($_SESSION['username'] || $_SESSION['hak_akses'])) {
		echo "<script>alert('Silahkan login terlebih dahulu !');document.location.href='../'</script>";
	} elseif ($_SESSION['hak_akses'] != "Admin") {
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
	<title>Admin</title>
	<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="../asset/css/datatables.min.css">
	<link rel="stylesheet" href="../asset/octicons/lib/octicons.css">
	<link rel="stylesheet" href="../asset/Fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="../asset/Fonts/open-iconic-master/font/css/open-iconic.min.css">
	<link rel="stylesheet" href="../asset/Fonts/open-iconic-master/font/css/open-iconic-bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body style="background-image: url('../foto/background/2.jpg');background-size: 100%">
	<form method="post">
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar navbar-brand" href="#"><img src="../foto/logo/7.png" width="40px"></a>
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="?menu=home"><span class="oi oi-home"></span> Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=tarif"><span class="oi oi-dollar"></span> Tarif</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=pelanggan"><span class="oi oi-people"></span> Pelanggan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=penggunaan"><span class="oi oi-flash"></span> Penggunaan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?menu=konfirmasi_pembayaran"><span class="oi oi-check"></span> Konfirmasi Pembayaran</a>
					</li>
					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				        	<span class="oi oi-file"></span> Laporan
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="?menu=laporan_pelanggan">Pelanggan <span class="oi oi-people"></span></a>
				          <a class="dropdown-item" href="?menu=laporan_penggunaan">Penggunaan <span class="oi oi-flash"></span></a>
				          <a class="dropdown-item" href="?menu=laporan_tagihan">Tagihan <span class="ion ion-clipboard"></span></a>
				          <a class="dropdown-item" href="?menu=laporan_pembayaran">Pembayaran <span class="ion ion-cash"></span></a>
				        </div>
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

					case 'tarif':
						include 'tarif.php';
						break;
					
					case 'pelanggan':
						include 'pelanggan.php';
						break;

					case 'penggunaan':
						include 'penggunaan.php';
						break;

					case 'konfirmasi_pembayaran':
						include 'konfirmasi_pembayaran.php';
						break;

					case 'laporan_pembayaran':
						include 'laporan_pembayaran.php';
						break;

					case 'laporan_tagihan':
						include 'laporan_tagihan.php';
						break;

					case 'laporan_penggunaan':
						include 'laporan_penggunaan.php';
						break;
					
					case 'laporan_pelanggan':
						include 'laporan_pelanggan.php';
						break;

					case 'logout':
						unset($_SESSION['username']);
						unset($_SESSION['hak_akses']);
						echo "<script>alert('Anda telah keluar !');document.location.href='../'</script>";
						break;
				}
			 ?>
		</div>
	</form>
</body>
<script src="../asset/js/jquery-3.3.1.min.js"></script>
<script src="../asset/js/bootstrap.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/bootstrap.bundle.min.js"></script>
<script src="../asset/datatables.min.js"></script>
<script>
	$(document).ready(function(){
		$('#data').DataTable({
			responsive: true
		});
	});
</script>
</html>