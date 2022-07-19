<?php 
	if (isset($_POST['cari'])) {
		if ($_POST['bulan'] == "" && $_POST['tahun'] == "") {
			$sql = mysql_query("SELECT * FROM query_tagihan ORDER BY id_tagihan ASC");
			echo "<script>alert('Pilih Bulan dan Tahun terlebih dahulu !')</script>";
		} else {
			if ($_POST['tahun'] == "") {
				$sql = mysql_query("SELECT * FROM query_tagihan WHERE bulan = '$_POST[bulan]' ORDER BY id_tagihan ASC");
			} elseif ($_POST['bulan'] == "") {
				$sql = mysql_query("SELECT * FROM query_tagihan WHERE tahun = '$_POST[tahun]' ORDER BY id_tagihan ASC");
			} else {
				$sql = mysql_query("SELECT * FROM query_tagihan WHERE bulan = '$_POST[bulan]' AND tahun = '$_POST[tahun]' ORDER BY id_tagihan ASC");
			}
		}
	} else {
		$sql = mysql_query("SELECT * FROM query_tagihan ORDER BY id_tagihan ASC");
	}
 ?>
<body>
	<form method="post">
		<div class="row justify-content-md-center">
			<div class="col-md-12 align-items-center">
				<div class="card" style="margin-top:5%">
					<div class="card-header badge-primary">
						<center>Laporan Tagihan Listrik</center>
					</div>
					<div class="card-body">
						<div class="form-inline justify-content-md-center">
							<label>bulan </label>
							<select class="form-control" name="bulan">
								<option selected disabled>00</option>
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
							<label>Tahun</label>
							<select class="form-control" name="tahun">
								<option selected disabled>0000</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2019">2020</option>
							</select>
							<button class="btn btn-outline-info" name="cari">Cari</button>
							<?php if (isset($_POST['cari'])): ?>
								<?php if ($_POST['tahun'] == ""): ?>
									<a href="cetak_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>&id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-danger">Cetak</a>
								<?php elseif ($_POST['bulan'] == ""): ?>
									<a href="cetak_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>&id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-danger">Cetak</a>
								<?php else: ?>
									<a href="cetak_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>&id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-danger">Cetak</a>
								<?php endif ?>
							<?php else: ?>
								<a href="cetak_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>&id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-danger">Cetak</a>
							<?php endif ?>

							<?php if (isset($_POST['cari'])): ?>
								<?php if ($_POST['tahun'] == ""): ?>
									<a href="export_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>" class="btn btn-outline-success">Excel</a>
								<?php elseif ($_POST['bulan'] == ""): ?>
									<a href="export_tagihan.php?id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-success">Excel</a>
								<?php else: ?>
									<a href="export_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>&id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-success">Excel</a>
								<?php endif ?>
							<?php else: ?>
								<a href="export_tagihan.php?id_bulan=<?php echo $_POST['bulan'] ?>&id_tahun=<?php echo $_POST['tahun'] ?>" class="btn btn-outline-success">Excel</a>
							<?php endif ?>
						</div>
						
						<br>

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