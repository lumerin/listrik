<?php
	session_start();
	error_reporting(0);
	include '../config/koneksi.php';
	$sql_struk = mysql_query("SELECT * FROM query_pembayaran WHERE id_pembayaran = '$_GET[id_pembayaran]' AND id_tagihan = '$_GET[id_tagihan]' AND id_pelanggan = '$_SESSION[username]' ");
	$struk = mysql_fetch_array($sql_struk);
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Laporan Pelanggan</title>
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
			width: 1000px;
		}
		.print{
			margin: 0 auto;
			width: 1000px;
		}
		a{
			text-decoration: none;

		}
	</style>

	<span class="oi oi-print" onclick="document.getElementById('print').style.display='none';window.print();" style="width=" id="print"></span>
	<br>
	<div class="utama">
		<table width="98%" cellspacing="0" cellpadding="0" align="center" style="margin-top: 10px;">
			<tr>
				<td width="7%" rowspan="4" align="center" valign="top">
					<img src="../foto/logo/7.png" width="55" height="55" /></td>
				<td width="93%" valign="top"><strong>&nbsp;Struk Pembayaran Listrik</strong></td>
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
		<div class="row justify-content-md-center">
			<div class="col-md-12">
				<table width="300px" cellspacing="0" cellpadding="0" style="margin-left: 30px;" align="left">
					<thead>
						<tr>
							<th class="text-left" colspan="2">Data Pelanggan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Id Pelanggan</td>
							<td class="text-right"><?php echo $struk['id_pelanggan'] ?></td>
						</tr>
						<tr>
							<td>No Meter</td>
							<td class="text-right"><?php echo $struk['no_meter'] ?></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td class="text-right"><?php echo $struk['nama'] ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td class="text-right"><?php echo $struk['alamat'] ?></td>
						</tr>
						<tr>
							<td>Daya/Tarif</td>
							<td class="text-right"><?php echo $struk['daya'] ?> VA / Rp. <?php echo number_format($struk['tarif_per_kwh'], '0', '', '.') ?></td>
						</tr>
					</tbody>
				</table>
				<table class="offset-8" width="300px" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th class="text-left" colspan="2">Data Tagihan</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Id Pembayaran</td>
							<td class="text-right"><?php echo $struk['id_pembayaran'] ?></td>
						</tr>
						<tr>
							<td>Bulan</td>
							<td class="text-right"><?php echo $struk['bulan'] ?></td>
						</tr>
						<tr>
							<td>Tahun</td>
							<td class="text-right"><?php echo $struk['tahun'] ?></td>
						</tr>
						<tr>
							<td>Total Meter</td>
							<td class="text-right"><?php echo $struk['jumlah_meter'] ?></td>
						</tr>
						<tr>
							<td>Total Tagihan</td>
							<td class="text-right">Rp. <?php echo number_format($struk['total_tagihan'], '0', '', '.') ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table width="300px" cellspacing="0" cellpadding="0" style="margin-left: 30px;" align="left">
					<thead>
						<tr>
							<th class="text-left" colspan="2">Data Transfer</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Atas Nama</td>
							<td class="text-right"><?php echo $struk['atas_nama'] ?></td>
						</tr>
						<tr>
							<td>No Rekening</td>
							<td class="text-right"><?php echo $struk['no_rekening'] ?></td>
						</tr>
						<tr>
							<td align="left">Bukti Pembayaran</td>
							<td class="text-right"><img src="../foto/bukti_pembayaran/<?php echo $struk['bukti_pembayaran'] ?>" width="400px" height="400px"></td>
						</tr>
					</tbody>
				</table>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<table class="offset-8" width="300px" cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th class="text-left" colspan="2">Data Pembayaran</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Denda</td>
							<td class="text-right">Rp. <?php echo number_format($struk['total_denda'], '0', '', '.') ?></td>
						</tr>
						<tr>
							<td>Biaya Admin</td>
							<td class="text-right">Rp. <?php echo number_format($struk['biaya_admin'], '0', '', '.') ?></td>
						</tr>
						<tr>
							<td>Total Tagihan</td>
							<td class="text-right">Rp. <?php echo number_format($struk['total_tagihan'], '0', '', '.') ?></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td>Total Pembayaran</td>
							<td class="text-right">Rp. <?php echo number_format($struk['total_pembayaran'], '0', '', '.') ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
	</div>

</body>
<center><p>&copy; <?php echo date('Y'); ?> PLN Kota Bogor</p></center>
<!-- <script>window.print()</script> -->
<script src="../asset/js/jquery-3.3.1.min.js"></script>
<script src="../asset/js/bootstrap.js"></script>
<script src="../asset/js/bootstrap.min.js"></script>
<script src="../asset/js/bootstrap.bundle.min.js"></script>
<script src="../asset/datatables.min.js"></script>
</html>
