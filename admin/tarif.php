<?php 
	if (isset($_POST['simpan'])) {
		if (empty($_POST['id_tarif'] || $_POST['daya'] || $_POST['tarif_per_kwh'] || $_POST['denda_keterlambatan'])) {
			echo "<script>alert('Harap masukan isi data yang kosong terlebih dahulu!')</script>";
		} else {
			if ($_POST['tarif_per_kwh'] == "0") {
				echo "<script>alert('Isi data tidak boleh 0 !')</script>";
			} else {
				$cek_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tarif"));
				if ($_POST['daya'] == $cek_data['daya']) {
					echo "<script>alert('Data sudah ada !')</script>";
				} else {
					$sql = mysql_query("INSERT INTO tbl_tarif VALUES('$_POST[id_tarif]', '$_POST[daya]', '$_POST[tarif_per_kwh]', '$_POST[denda_keterlambatan]')");

					if ($sql) {
						echo "<script>alert('Data telah disimpan !');document.location.href='?menu=tarif'</script>";
					} else {
						echo mysql_error();
					}
				}
			}
		}
	}

	if (isset($_GET['edit'])) {
		$sql = mysql_query("SELECT * FROM tbl_tarif WHERE id_tarif = '$_GET[id]'");
		$edit = mysql_fetch_array($sql);
	}

	if (isset($_POST['ubah'])) {
		if (empty($_POST['id_tarif'] || $_POST['daya'] || $_POST['tarif_per_kwh'] || $_POST['denda_keterlambatan'])) {
			echo "<script>alert('Harap masukan isi data yang kosong terlebih dahulu!')</script>";
		} else {
			if ($_POST['daya'] == "0" || $_POST['tarif_per_kwh'] == "0") {
				echo "<script>alert(' Isi data tidak boleh 0 !')</script>";
			} else {
				$cek_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tarif"));
				if ($_POST['daya'] == $cek_data['daya']) {
					echo "<script>alert('Data sudah ada !')</script>";
				} else {
					$sql = mysql_query("UPDATE tbl_tarif SET id_tarif = '$_POST[id_tarif]', daya = '$_POST[daya]', tarif_per_kwh = '$_POST[tarif_per_kwh]', denda_keterlambatan = '$_POST[denda_keterlambatan]' WHERE id_tarif = '$_GET[id]'");

					if ($sql) {
						echo "<script>alert('Data telah diubah !');document.location.href='?menu=tarif'</script>";
					} else {
						echo mysql_error();
					}
				}
			}
		}
	}

	if (isset($_GET['hapus'])) {
		$sql = mysql_query("DELETE FROM tbl_tarif WHERE id_tarif = '$_GET[id]'");

		if ($sql) {
			echo "<script>alert('Data telah dihapus !');document.location.href='?menu=tarif'</script>";
		} else {
			echo mysql_error();
		}
	}
 ?>
<body>
	<div class="row justify-content-md-center">
		<div class="col-md-4 align-items-center">
			<br>
			<form method="post">
				<div class="card">
					<div class="card-header badge-primary">
						<center><span class="oi oi-dollar"></span> Tarif</center>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Id Tarif</label>
							<?php 
								$sql_kode = mysql_query("SELECT * FROM tbl_tarif");
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
							 	<input type="text" class="form-control" name="id_tarif" value="<?php echo $edit['id_tarif'] ?>" readonly>
							 <?php else: ?>
							 	<input type="text" class="form-control" name="id_tarif" value="<?php echo "TF$kode" ?>" readonly>
							 <?php endif ?>
						</div>
						<div class="form-group">
							<label>Daya</label>
							<div class="input-group">
								<input type="text" class="form-control" name="daya" value="<?php echo $edit['daya']  ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5" placeholder="0 VA" required>
								<span class="input-group-addon">VA</span>
							</div>
						</div>
						<div class="form-group">
							<label>Tarif/Kwh</label>
							<div class="input-group">
								<div class="input-group-addon">Rp.</div>
								<input type="text" class="form-control" name="tarif_per_kwh" value="<?php echo $edit['tarif_per_kwh'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" placeholder="Rp. 0/Kwh" required>
								<div class="input-group-addon">/Kwh</div>
							</div>
						</div>
						<div class="form-group">
							<label>Denda</label>
							<div class="input-group">
								<div class="input-group-addon">Rp.</div>
								<input type="text" class="form-control" name="denda_keterlambatan" value="<?php echo $edit['denda_keterlambatan'] ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Rp. 0" required>
							</div>
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
					<table class="table table-hover" id="data" align="center">
						<thead>
							<th scope="col" class="text-center">Id Tarif</th>
							<th scope="col" class="text-center">Daya</th>
							<th scope="col" class="text-center">Tarif/Kwh</th>
							<th scope="col" class="text-center">Denda</th>
							<th scope="col" class="text-center">Aksi</th>
						</thead>
						<tbody>
							<?php 
								if (isset($_POST['cari'])) {
									if ($_POST['text_cari'] != "") {
										$sql = mysql_query("SELECT * FROM tbl_tarif WHERE id_tarif LIKE '%$_POST[text_cari]%' OR daya LIKE '%$_POST[text_cari]%' OR tarif_per_kwh LIKE '%$_POST[text_cari]%' OR denda_keterlambatan LIKE '%$_POST[text_cari]%' ORDER BY id_tarif ASC");
									} else {
										$sql = mysql_query("SELECT * FROM tbl_tarif ORDER BY id_tarif ASC");	
									}
								} else {
									$sql = mysql_query("SELECT * FROM tbl_tarif ORDER BY id_tarif ASC");
								}

								while ($data = mysql_fetch_array($sql)) {
							 ?>

							 <tr>
							 	<td scope="col" class="text-center"><?php echo $data['id_tarif'] ?></td>
							 	<td scope="col" class="text-right"><?php echo $data['daya'] ?> VA</td>
							 	<td scope="col" class="text-right">Rp. <?php echo number_format($data['tarif_per_kwh'], '0', '', '.') ?>/Kwh</td>
							 	<td scope="col" class="text-right">Rp. <?php echo $data['denda_keterlambatan'] ?></td>
							 	<td scope="col"><a href="?menu=tarif&edit&id=<?php echo $data['id_tarif'] ?>"><span class="oi oi-pencil"></span></a> <a href="?menu=tarif&hapus&id=<?php echo $data['id_tarif'] ?>" class="offset-6"><span class="oi oi-trash"></span></a></td>
							 </tr>

							 <?php } ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>