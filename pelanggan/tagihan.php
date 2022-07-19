<body>
	<form method="post">
		<div class="row justify-content-md-center">
			<div class="col-md-auto align-items-center">
				<div class="card" style="margin-top:5%">
					<div class="card-header badge-primary">
						<center>Tagihan Listrik</center>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="data" align="center">
							<thead>
								<tr>
									<th scope="col" class="text-center">Id Tagihan</th>
									<th scope="col" class="text-center">Id Pelanggan</th>
									<th scope="col" class="text-center">Bulan</th>
									<th scope="col" class="text-center">Tahun</th>
									<th scope="col" class="text-center">Jumlah Meter</th>
									<th scope="col" class="text-center">Total Tagihan</th>
									<th scope="col" class="text-center">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql = mysql_query("SELECT * FROM tbl_tagihan WHERE id_pelanggan = '$_SESSION[username]' AND (status = '-' OR status = 'Belum')");
									while ($data = mysql_fetch_array($sql)) {
								 ?>
								 <tr>
								 	<td scope="col" class="text-center"><?php echo $data['id_tagihan'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['id_pelanggan'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['bulan'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['tahun'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['jumlah_meter'] ?> Kwh</td>
								 	<td scope="col" class="text-center">Rp. <?php echo $data['total_tagihan'] ?>/Kwh</td>
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