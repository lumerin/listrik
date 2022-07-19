<?php 
	error_reporting(0);
	include '../config/koneksi.php';
	header("Content-type: application/vnd-ms-excel");
	header("Content-disposition: attachment; filename=laporantagihanlistrik.xls");
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Laporan Listrik</title>
	<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
	<link rel="stylesheet" href="../asset/css/datatables.min.css">
	<link rel="stylesheet" href="../asset/octicons/lib/octicons.css">
	<link rel="stylesheet" href="../asset/Fonts/ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="../asset/Fonts/open-iconic-master/font/css/open-iconic.min.css">
	<link rel="stylesheet" href="../asset/Fonts/open-iconic-master/font/css/open-iconic-bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
	<style>
		.utama{
			margin: 0 auto;
			border:thin solid #000;
			width: 100px;
		}
		a{
			text-decoration: none;

		}
	</style>


	<br>
	<div class="utama">
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-top: 10px;">
			<tr>
				<td width="7%" rowspan="4" align="center" valign="top">
					<img src="../foto/logo/7.png" width="55" height="55" /></td>
				<td width="93%" valign="top"><strong>&nbsp;Laporan Data Tagihan Listrik</strong></td>
			</tr>
			<tr>
				<td valign="top">&nbsp;PLN Kota Bogor</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;Jl. Batutulis No. 114 Kec. Bogor Selatan, Kota Bogor, Jawa Barat 66432</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;pln-kota-bogor@pln.co.id</td>
			</tr>
		</table>
		<table width="100%">
			<tr><td><hr></td></tr>
		</table>	
		<table cellspacing="1" width="90%" align="center" border="1">
			<thead>
				<tr>
					<th scope="col" class="text-center">Id Tagihan</th>
					<th scope="col" class="text-center">Id Pelanggan</th>
					<th scope="col" class="text-center">No Meter</th>
					<th scope="col" class="text-center">Nama</th>
					<th scope="col" class="text-center">Alamat</th>
					<th scope="col" class="text-center">Bulan</th>
					<th scope="col" class="text-center">Tahun</th>
					<th scope="col" class="text-center">Jumlah Meter</th>
					<th scope="col" class="text-center">Total Tagihan</th>
					<th scope="col" class="text-center">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if (($_GET['id_bulan'] == "") AND ($_GET['id_tahun'] == "")) {
						$sql = mysql_query("SELECT * FROM query_pelanggan ORDER BY id_pelanggan ASC");
					} elseif ($_GET['id_tahun'] == "") {
						$sql = mysql_query("SELECT * FROM query_pelanggan WHERE substr(tgl_daftar, 6, 2) = '$_GET[id_bulan]' ORDER BY id_pelanggan ASC");
					} elseif ($_GET['id_bulan'] == "") {
						$sql = mysql_query("SELECT * FROM query_pelanggan WHERE substr(tgl_daftar, 1, 4) = '$_GET[id_tahun]' ORDER BY id_pelanggan ASC");
					} else {
						$sql = mysql_query("SELECT * FROM query_pelanggan WHERE substr(tgl_daftar, 6, 2) = '$_GET[id_bulan]' AND substr(tgl_daftar, 1, 4) = '$_GET[id_tahun]' ORDER BY id_pelanggan ASC");
					}

					while ($data = mysql_fetch_array($sql)) {
					 ?>


				<tr>
					<td scope="col" class="text-center"><?php echo $data['id_tagihan'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['id_pelanggan'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['no_meter'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['nama'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['alamat'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['bulan'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['tahun'] ?></td>
					<td scope="col" class="text-center"><?php echo $data['jumlah_meter'] ?> Kwh</td>
					<td scope="col" class="text-center">Rp. <?php echo $data['total_tagihan'] ?></td>
				 	<td scope="col" class="text-center"><?php echo $data['status'] ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>	
		<br>
	</div>

</body>
<center><p>&copy; <?php echo date('Y'); ?> PLN Kota Bogor</p></center>
<script src="../asset/js/jquery-3.3.1.min.js"></script>
<script src="../asset/js/bootstrap.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/bootstrap.bundle.min.js"></script>
<script src="../asset/datatables.min.js"></script>
</html>

<?php 
	error_reporting(0);
	include '../config/koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<form method="post">
		<div class="row justify-content-md-center">
			<div class="col-md-10 align-items-center">
				<div class="card" style="margin-top:5%">
					<div class="card-header badge-primary">
						<center>Laporan Tagihan Listrik</center>
					</div>
					<div class="card-body">
						<table class="table table-hover" align="center">
							<thead>
								<tr>
									<th scope="col" class="text-center">Id Tagihan</th>
									<th scope="col" class="text-center">Id Pelanggan</th>
									<th scope="col" class="text-center">No Meter</th>
									<th scope="col" class="text-center">Nama</th>
									<th scope="col" class="text-center">Alamat</th>
									<th scope="col" class="text-center">Bulan</th>
									<th scope="col" class="text-center">Tahun</th>
									<th scope="col" class="text-center">Jumlah Meter</th>
									<th scope="col" class="text-center">Total Tagihan</th>
									<th scope="col" class="text-center">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$substr_bulan = substr($_GET[id], 0, 2);
								$substr_tahun = substr($_GET[id], 2, 4);
								if ($_GET['id'] != "") {
									$sql = mysql_query("SELECT * FROM query_tagihan WHERE bulan = '$substr_bulan' AND tahun = '$substr_tahun' ORDER BY id_tagihan ASC");
								} else {
									$sql = mysql_query("SELECT * FROM query_tagihan ORDER BY id_tagihan ASC");
								}
								while ($data = mysql_fetch_array($sql)) {
								 ?>
								<tr>
									<td scope="col" class="text-center"><?php echo $data['id_tagihan'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['id_pelanggan'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['no_meter'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['nama'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['alamat'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['bulan'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['tahun'] ?></td>
									<td scope="col" class="text-center"><?php echo $data['jumlah_meter'] ?> Kwh</td>
									<td scope="col" class="text-center">Rp. <?php echo $data['total_tagihan'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['status'] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
<script>window.print();</script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-1.11.2.min.js"></script>
</html>