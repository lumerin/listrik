<?php 
	if (isset($_POST['simpan'])) {
		if (empty($_POST['id_tarif'] || $_POST['no_meter'] || $_POST['nama'] || $_POST['password'] || $_POST['alamat'] || $_POST['id_tarif'])) {
			echo "<script>alert('Harap masukan isi data yang kosong terlebih dahulu!')</script>";
		} else {
			$cekdata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan"));
			if ($_POST['alamat'] == $cekdata['alamat']) {
				echo "<script>alert('Data sudah ada !')</script>";
			} else {
				$tgl = date("Y-m-d");
				$sql = mysql_query("INSERT INTO tbl_pelanggan VALUES('$_POST[id_pelanggan]', '$_POST[no_meter]', '$_POST[nama]', '$_POST[password]', '$_POST[alamat]', '$tgl', '$_POST[id_tarif]')");

				if ($sql) {
					echo "<script>alert('Data telah disimpan !');document.location.href='?menu=pelanggan'</script>";
				} else {
					echo mysql_error();
				}
			}
			
		}
	}

	if (isset($_GET['edit'])) {
		$sql = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$_GET[id]'");
		$edit = mysql_fetch_array($sql);
	}

	if (isset($_POST['ubah'])) {
		if (empty($_POST['id_tarif'] || $_POST['no_meter'] || $_POST['nama'] || $_POST['password'] || $_POST['alamat'] || $_POST['id_tarif'])) {
			echo "<script>alert('Harap masukan isi data yang kosong terlebih dahulu!')</script>";
		} else {
			$cekdata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pelanggan"));
			if ($_POST['alamat'] == $cekdata['alamat']) {
				echo "<script>alert('Data sudah ada !')</script>";
			} else {
				$sql = mysql_query("UPDATE tbl_pelanggan SET id_pelanggan = '$_POST[id_pelanggan]', no_meter = '$_POST[no_meter]', nama = '$_POST[nama]', password = '$_POST[password]', alamat = '$_POST[alamat]', id_tarif = '$_POST[id_tarif]' WHERE id_pelanggan = '$_GET[id]'");

				if ($sql) {
					echo "<script>alert('Data telah diubah !');document.location.href='?menu=pelanggan'</script>";
				} else {
					echo mysql_error();
				}
			}
		}
	}

	if (isset($_GET['hapus'])) {
		$cektagihan = mysql_num_rows(mysql_query("SELECT * FROM tbl_tagihan WHERE id_pelanggan = '$_GET[id]' AND (status = '-' OR status = 'Belum')"));
		if ($cektagihan > 0) {
			echo "<script>alert('Masih ada Tagihan yang belum dibayar !')</script>";
		} else {
			$sql1 = mysql_query("DELETE FROM tbl_pelanggan WHERE id_pelanggan = '$_GET[id]'");
			$sql2 = mysql_query("DELETE FROM tbl_penggunaan WHERE id_pelanggan = '$_GET[id]'");
			$sql3 = mysql_query("DELETE FROM tbl_tagihan WHERE id_pelanggan = '$_GET[id]'");
			$sql_hapus_tagihan = mysql_query("SELECT * FROM tbl_tagihan WHERE id_tagihan = '$_GET[id]'");
			$hapus_tagihan = mysql_fetch_array($sql_hapus_tagihan); 
			$sql4 = mysql_query("DELETE FROM tbl_pembayaran WHERE id_tagihan = '$hapus_tagihan[id_tagihan]'");

			if ($sql1 && $sql2 && $sql3) {
				echo "<script>alert('Data telah dihapus !');document.location.href='?menu=pelanggan'</script>";
			} else {
				echo mysql_error();
			}
		}
	}
 ?>
<body>
	<div class="row justify-content-md-center">
		<div class="col-md-4 col-lg-4 col-xl-4 align-items-center">
			<br>
			<form method="post">
				<div class="card">
					<div class="card-header badge-primary">
						<center><span class="oi oi-people"></span> Pelanggan</center>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Id Tarif</label>
							<?php 
								$sql_kode = mysql_query("SELECT * FROM tbl_pelanggan");
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

							 <?php if (isset($_GET['edit'])): ?>
							 	<input type="text" class="form-control" name="id_pelanggan" value="<?php echo $edit['id_pelanggan'] ?>" maxlength="11" readonly required>
							 <?php else: ?>
							 	<input type="text" class="form-control" name="id_pelanggan" value="<?php echo "PN$kode" ?>" maxlength="11" readonly required>
							 <?php endif ?>
						</div>
						<div class="form-group">
							<label>No Meter</label>
								<?php 
									$sql_no_meter = mysql_query("SELECT * FROM tbl_pelanggan");
									$cek = mysql_num_rows($sql_no_meter);
									$angka = $cek + 1;
									if ($angka <= 9) {
										$id_no_meter = "0000000000$angka";
									} elseif ($angka <= 99) {
										$id_no_meter = "000000000$angka";
									} elseif ($angka <= 999) {
										$id_no_meter = "00000000$angka";
									} elseif ($angka <= 9999) {
										$id_no_meter = "0000000$angka";
									} elseif ($angka <= 99999) {
										$id_no_meter = "00000$angka";
									} elseif ($angka <= 999999) {
										$id_no_meter = "0000$angka";
									} elseif ($angka <= 9999999) {
										$id_no_meter = "000$angka";
									} elseif ($angka <= 9999999) {
										$id_no_meter = "00$angka";
									} elseif ($angka <= 9999999) {
										$id_no_meter = "0$angka";
									} else {
										$id_no_meter = $angka;
									}
								 ?>
								<?php if (isset($_GET['edit'])): ?>
									<input type="text" class="form-control" name="no_meter" value="<?php echo $edit['no_meter']  ?>" maxlength="11" readonly required>
								<?php else: ?>
									<input type="text" class="form-control" name="no_meter" value="<?php echo $id_no_meter  ?>" maxlength="11" readonly required>
								<?php endif ?>
						</div>
						<div class="form-group">
 							<label>Nama</label>
								<input type="text" class="form-control" name="nama" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 32) )" value="<?php echo $edit['nama'] ?>" maxlength="50" placeholder="Nama" required>
						</div>
						<div class="form-group">
							<label>Password</label>
								<input type="text" class="form-control" name="password" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 32))" value="<?php echo $edit['password'] ?>" maxlength="50" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="alamat" onkeypress="return ((event.charCode >= 97 && event.charCode <= 122 ) || (event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode == 46) || (event.charCode == 32))" rows="5" placeholder="Alamat" required><?php echo $edit['alamat'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Daya</label>
							<select class="form-control" name="id_tarif" required>
								<?php if (isset($_GET['edit'])): ?>
									<?php 
										$sql_daya = mysql_query("SELECT * FROM tbl_tarif WHERE id_tarif = '$edit[id_tarif]'");
										$daya = mysql_fetch_array($sql_daya);
									 ?>
									<option value="<?php echo $edit['id_tarif'] ?>"><?php echo $daya['daya'] ?> / Rp.<?php echo $daya['daya'] ?>/Kwh</option>
								<?php else: ?>
									<option selected disabled>--Silahkan pilih daya--</option>
								<?php endif ?>
								
								<?php 
									$sql_tarif = mysql_query("SELECT * FROM tbl_tarif");
									while ($tarif = mysql_fetch_array($sql_tarif)) {
								 ?>
									<option value="<?php echo $tarif['id_tarif'] ?>"><?php echo $tarif['daya'] ?> / Rp. <?php echo $tarif['tarif_per_kwh'] ?>/Kwh</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<?php if (isset($_GET['edit'])): ?>
								<button class="btn btn-primary" name="ubah"><span class="ion ion-archive"></span> Ubah</button>
							<?php else: ?>
								<button class="btn btn-primary" name="simpan"><span class="ion ion-archive"></span> Simpan</button>
							<?php endif ?>
						</div>
					</div>
				</div>
			</form>
		</div>
	
		<div class="col-md-8">
			<br>
			<div class="card">
				<div class="card-header badge-primary">
					<center>Data</center>
				</div>
				<div class="card-body">
					<div class="col-md-12">
						<table class="table table-hover" id="data" align="center">
							<thead>
								<tr>
								<th scope="col" class="text-center">Id Pelanggan</th>
								<th scope="col" class="text-center">no_meter</th>
								<th scope="col" class="text-center">Nama</th>
								<th scope="col" class="text-center">Password</th>
								<th scope="col" class="text-center">Alamat</th>
								<th scope="col" class="text-center">Tanggal Pendaftaran</th>
								<th scope="col" class="text-center">Daya</th>
								<th scope="col" class="text-center">Aksi</th>
							</tr>
							</thead>
							<tbody>
								<?php 
									$sql = mysql_query("SELECT tbl_pelanggan.*, tbl_tarif.daya FROM tbl_pelanggan INNER JOIN tbl_tarif ON tbl_pelanggan.id_tarif = tbl_tarif.id_tarif ORDER BY id_pelanggan ASC");
									while ($data = mysql_fetch_array($sql)) {
								 ?>
								 <tr>
								 	<td scope="col" class="text-center"><?php echo $data[0] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data[1] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data[2] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data[3] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data[4] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data[5] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['daya'] ?></td>
								 	<td scope="col" class="text-center"><a href="?menu=pelanggan&edit&id=<?php echo $data['id_pelanggan'] ?>"><span class="oi oi-pencil"></span></a>  <a href="?menu=pelanggan&hapus&id=<?php echo $data['id_pelanggan'] ?>"><span class="oi oi-trash"></span></a></td>
								 </tr>
								 <?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>