<?php
	$tahun_skrng = date("Y");
	$bulan_skrng = date("m");
	$tanggal_skrng = date("d");
 ?>
<body>
	<div class="row justify-content-md-center">
		<div class="col-md-4 align-items-center">
			<br>
			<form method="post">
				<div class="card">
					<div class="card-header badge-primary">
						<center><span class="oi oi-person"></span> Pelanggan</center>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Id Penggunaan</label>
							<?php
								$sql_kode = mysql_query("SELECT * FROM tbl_penggunaan");
								$cek_kode = mysql_num_rows($sql_kode);
								$angka_kode = $cek_kode + 1;

								if ($angka_kode <= 9) {
									$kode = "0000$angka_kode";
								} elseif ($angka_kode <= 99) {
									$kode = "000$angka_kode";
								} elseif ($angka_kode <= 999) {
									$kode = "00$angka_kode";
								} elseif ($angka_kode <= 9999) {
									$kode = "0$angka_kode";
								} else {
									$kode = $angka_kode;
								}
							 ?>
						 	<input type="text" class="form-control" name="id_penggunaan" value="<?php echo "PG$kode" ?>" readonly>
						</div>
						<div class="form-group">
							<label>Id Pelanggan</label>
							<div class="row" style="margin-left: -10%">
								<?php if (isset($_POST['cek'])): ?>
									<?php
										$sql_pelanggan = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
										$id_pelanggan = mysql_fetch_array($sql_pelanggan);
									 ?>
									<input type="text" class="col-md-8 offset-1 form-control" name="id_pelanggan" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 32))" value="<?php echo $id_pelanggan['id_pelanggan'] ?>" maxlength="7" required><button class="btn btn-info" name="cek"><span class="ion ion-search"></span> Cek</button>
								<?php else: ?>
									<input type="text" class="col-md-8 offset-1 form-control" name="id_pelanggan" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 32))" maxlength="7" required><button class="btn btn-info" name="cek"><span class="ion ion-search"></span> Cek</button>
								<?php endif ?>
							</div>
						</div>
						<div class="form-group">
							<label>No Meter</label>
							<?php if (isset($_POST['cek'])): ?>
								<?php
									$sql_no_meter = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
									$no_meter = mysql_fetch_array($sql_no_meter);
								 ?>
									<input type="text" class="form-control" name="nama" value="<?php echo $no_meter['no_meter'] ?>" readonly>
								<?php else: ?>
									<input type="text" class="form-control" name="nama" readonly>
							<?php endif ?>
						</div>

						<div class="form-group">
							<label>Nama</label>
							<?php if (isset($_POST['cek'])): ?>
								<?php
									$sql_nama = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
									$nama = mysql_fetch_array($sql_nama);
								 ?>
									<input type="text" class="form-control" name="nama" value="<?php echo $nama['nama'] ?>" readonly>
								<?php else: ?>
									<input type="text" class="form-control" name="nama" readonly>
							<?php endif ?>
						</div>
					</div>
				</div>
				<br>
				<div class="card">
					<div class="card-header badge-primary">
						<center><span class="oi oi-flash"></span> Penggunaan</center>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Bulan</label>
							<?php if (isset($_POST['cek'])): ?>
								<?php
									$sql_bulan_penggunaan = mysql_query("SELECT * FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
									$cek_bulan_penggunaan = mysql_num_rows($sql_bulan_penggunaan);
								 ?>
								 <?php if ($cek_bulan_penggunaan < 1): ?>
								 	<?php
								 		$sql_bulan = mysql_query("SELECT tgl_daftar FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
								 		$cek_bulan = mysql_fetch_array($sql_bulan);
								 		$bulan = substr($cek_bulan[0], 5, 2) + 1;
								 	 ?>
								 	 <?php if ($bulan > 12): ?>
								 	 	<?php
								 				$bulan = 1;
								 			 ?>
								 		<input type="text" class="form-control" name="bulan" value="<?php echo $bulan ?>" readonly>
								 	<?php else: ?>
								 		<input type="text" class="form-control" name="bulan" value="<?php echo $bulan ?>" readonly>
								 	 <?php endif ?>
								 <?php else: ?>
								 	 <?php
								 	 	$sql_bulan = mysql_query("SELECT MAX(bulan) FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
								 	 	$cek_bulan = mysql_fetch_array($sql_bulan);
								 	 	$bulan = $cek_bulan[0] + 1;
								 	  ?>
								 		<?php if ($bulan > 12): ?>
								 			<?php
								 				$bulan = 1;
								 			 ?>
								 			<input type="text" class="form-control" name="bulan" value="<?php echo $bulan ?>" readonly>
								 		<?php else: ?>
								 			<input type="text" class="form-control" name="bulan" value="<?php echo $bulan ?>" readonly>
								 	 	<?php endif ?>
								 <?php endif ?>
							<?php else: ?>
								<input type="text" class="form-control" name="bulan" readonly>
							<?php endif ?>
						</div>
						<div class="form-group">
							<label>Tahun</label>
							<?php if (isset($_POST['cek'])): ?>
								<?php
									$sql_penggunaan = mysql_query("SELECT * FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
									$cek_penggunaan = mysql_num_rows($sql_penggunaan);
								 ?>
								 <?php if ($cek_penggunaan < 1): ?>
								 	<?php
								 		$sql_bulan2 = mysql_query("SELECT tgl_daftar FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
								 		$sql_tahun = mysql_query("SELECT tgl_daftar FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
								 		$cek_bulan2 = mysql_fetch_array($sql_bulan2);
								 		$cek_tahun = mysql_fetch_array($sql_tahun);
								 		$bulan2 = substr($cek_bulan2[0], 5, 2) + 1;
								 		$tahun = substr($cek_tahun[0], 0, 4);
								 	 ?>
								 	 <?php if ($bulan2 > 12): ?>
								 	 	<?php
								 				$bulan2 = 1;
								 				$tahun = $tahun + 1

								 			 ?>
								 		<input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" readonly>
								 	<?php else: ?>
								 		<input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" readonly>
								 	 <?php endif ?>
								 <?php else: ?>
								 	 <?php
								 	 	$sql_bulan2 = mysql_query("SELECT MAX(bulan) FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
								 	 	$sql_tahun = mysql_query("SELECT MAX(tahun) FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
								 	 	$cek_bulan2 = mysql_fetch_array($sql_bulan2);
								 	 	$cek_tahun = mysql_fetch_array($sql_tahun);
								 	 	$bulan2 = $cek_bulan2[0] + 1;
								 	 	$tahun = $cek_tahun[0];
								 	  ?>
								 		<?php if ($bulan2 > 12): ?>
								 			<?php
								 				$bulan2 = 1;
								 				$tahun = $tahun + 1;
								 			 ?>
								 			<input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" readonly>
								 		<?php else: ?>
								 			<input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" readonly>
								 	 	<?php endif ?>
								 <?php endif ?>
							<?php else: ?>
								<input type="text" class="form-control" name="tahun" readonly>
							<?php endif ?>
						</div>
						<div class="form-group">
							<label>Meter Awal</label>
							<div class="input-group">
								<?php if (isset($_POST['cek'])): ?>
									<?php
										$sql_meter = mysql_query("SELECT MAX(meter_akhir) FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
										$sql_cek_meter = mysql_query("SELECT COUNT(id_pelanggan) FROM tbl_penggunaan WHERE id_pelanggan = '$_POST[id_pelanggan]'");
										$meter = mysql_fetch_array($sql_meter);
										$cek_meter = mysql_fetch_array($sql_cek_meter);

										 ?>

									<?php if ($cek_meter[0] > 0): ?>
										<input type="text" class="form-control" name="meter_awal" maxlength="5" value="<?php echo $meter[0] ?>" readonly>
									<?php else: ?>
										<input type="text" class="form-control" name="meter_awal" maxlength="5" value="<?php echo '0'?>" readonly>
									<?php endif ?>
								<?php else: ?>
									<input type="text" class="form-control" name="meter_awal" maxlength="5" readonly>
								<?php endif ?>
								<div class="input-group-addon">/Kwh</div>
							</div>
						</div>
						<div class="form-group">
							<label>Meter Akhir</label>
							<div class="input-group">
								<input type="text" class="form-control" name="meter_akhir" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" placeholder="0">
								<div class="input-group-addon">/Kwh</div>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" name="simpan"><span class="ion ion-archive"></span> Simpan</button>
						</div>
						<?php
							if (isset($_POST['simpan'])) {
								if (empty($_POST['id_tarif'] || $_POST['id_pelanggan'] || $_POST['bulan'] || $_POST['tahun'] || $_POST['meter_awal'] || $_POST['meter_akhir'])) {
									$pelanggan = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_POST[id_pelanggan]'"));
									echo "<script>alert('Harap masukan isi data yang kosong terlebih dahulu!')</script>";
								} else {
									$tarif = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tarif WHERE id_tarif = '$pelanggan[id_tarif]'"));

									$sql_tagihan = mysql_query("SELECT * FROM tbl_tagihan");
									$cek_tagihan = mysql_num_rows($sql_tagihan);
									$data_tagihan = $cek_tagihan + 1;

									if ($data_tagihan <= 9) {
										$kode_tagihan = "0000$data_tagihan";
									} elseif ($data_tagihan <= 99) {
										$kode_tagihan = "000$data_tagihan";
									} elseif ($data_tagihan <= 999) {
										$kode_tagihan = "00$data_tagihan";
									} elseif ($data_tagihan <= 9999) {
										$kode_tagihan = "0$data_tagihan";
									} else {
										$kode_tagihan = $data_tagihan;
									}

									$kodenya_tagihan = "TN$kode_tagihan";
									$jumlah_meter = $_POST['meter_akhir'] - $_POST['meter_awal'];
									$total_tagihan = $jumlah_meter * $tarif['tarif_per_kwh'];
									if ($_POST['meter_akhir'] < $_POST['meter_awal']) {
										echo "<script>alert('Meter Akhir harus lebih dari meter awal !')</script>";
									} else {
										if ($tahun_skrng < $_POST['tahun']) {
											echo "<script>alert('Waktu pemasukan penggunaan listrik sudah lewat (tahun)!')</script>";
										} elseif ($tahun_skrng > $_POST['tahun']){
											echo "<script>alert('Belum waktunya memasukan penggunaan listrik !')</script>";
										} else {
											if ($bulan_skrng < $_POST['bulan']) {
												echo "<script>alert('Waktu pemasukan penggunaan listrik sudah lewat !')</script>";
											} elseif($bulan_skrng > $_POST['bulan']) {
												echo "<script>alert('Belum waktunya memasukan penggunaan listrik !')</script>";
											} else {
												if ($tanggal_skrng < 25) {
													echo "<script>alert('Belum waktunya menginput penggunaan listrik !')</script>";
												} else {
													$sql1 = mysql_query("INSERT INTO tbl_penggunaan VALUES('$_POST[id_penggunaan]', '$_POST[id_pelanggan]', '$_POST[bulan]', '$_POST[tahun]', '$_POST[meter_awal]', '$_POST[meter_akhir]')");
													$sql2 = mysql_query("INSERT INTO tbl_tagihan VALUES('$kodenya_tagihan', '$_POST[id_penggunaan]', '$_POST[id_pelanggan]', '$_POST[bulan]', '$_POST[tahun]', '$jumlah_meter', '$total_tagihan', '-')");
													if ($sql1 && $sql2) {
														echo "<script>alert('Data berhasil disimpan !');document.location.href='?menu=penggunaan'</script>";
													} else {
														echo mysql_error();
													}
												}
											}
										}
									}
								}
							}


							if (isset($_GET['hapus'])) {
								$sql1 = mysql_query("DELETE FROM tbl_penggunaan WHERE id_penggunaan = '$_GET[id]'");
								$sql2 = mysql_query("DELETE FROM tbl_tagihan WHERE id_penggunaan = '$_GET[id]'");
								if ($sql1 && $sql2) {
									echo "<script>alert('Data berhasil dihapus !');document.location.href='?menu=penggunaan'</script>";
								} else {
									echo mysql_error();
								}
							}
						 ?>
					</div>
				</div>
			</form>
		</div>


		<div class="col-md-8">
			<br>
			<div class="card">
				<div class="card-header badge-primary">
					<center><span class="fa"></span> Data</center>
				</div>
				<div class="card-body">
					<table class="table table-hover" id="data" align="center">
						<thead>
							<th scope="col" class="text-center">Id Penggunaan</th>
							<th scope="col" class="text-center">Id Pelanggan</th>
							<th scope="col" class="text-center">Bulan</th>
							<th scope="col" class="text-center">Tahun</th>
							<th scope="col" class="text-center">Meter Awal</th>
							<th scope="col" class="text-center">Meter Akhir</th>
							<th scope="col" class="text-center">Aksi</th>
						</thead>
						<tbody>
							<?php
								$sql = mysql_query("SELECT * FROM tbl_penggunaan ORDER BY id_penggunaan ASC");

								while ($data = mysql_fetch_array($sql)) {
							 ?>

							 <tr>
							 	<td scope="col" class="text-center"><?php echo $data['id_penggunaan'] ?></td>
							 	<td scope="col" class="text-center"><?php echo $data['id_pelanggan'] ?></td>
							 	<td scope="col" class="text-center"><?php echo $data['bulan'] ?></td>
							 	<td scope="col" class="text-center"><?php echo $data['tahun'] ?></td>
							 	<td scope="col" class="text-center"><?php echo $data['meter_awal'] ?></td>
							 	<td scope="col" class="text-center"><?php echo $data['meter_akhir'] ?></td>
							 	<td scope="col" class="text-center"><a href="?menu=penggunaan&hapus&id=<?php echo $data['id_penggunaan'] ?>">Hapus</a></td>
							 </tr>

							 <?php } ?>

						</tbody>
					</table>
				</div>
		</div>
	</div>
</body>
