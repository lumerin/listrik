<body>
	<form method="post">
		<div class="row justify-content-md-center">
			<div class="col-md-12 align-items-center">
				<div class="card" style="margin-top:5%">
					<div class="card-header badge-primary">
						<center>Pembayaran Listrik</center>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="data" align="center">
							<thead>
								<tr>
									<th scope="col" class="text-center">Id Pembayaran</th>
									<th scope="col" class="text-center">Id Tagihan</th>
									<th scope="col" class="text-center">Denda</th>
									<th scope="col" class="text-center">Tanggal</th>
									<th scope="col" class="text-center">Biaya Admin</th>
									<th scope="col" class="text-center">Atas Nama</th>
									<th scope="col" class="text-center">No Rekening</th>
									<th scope="col" class="text-center">Bukti Pembayaran</th>
									<th scope="col" class="text-center">Status</th>
									<th scope="col" class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql_cek = mysql_query("SELECT * FROM tbl_tagihan WHERE id_pelanggan = '$_SESSION[username]'");
									while ($cek = mysql_fetch_array($sql_cek)) {
										$sql = mysql_query("SELECT * FROM tbl_pembayaran WHERE id_tagihan = '$cek[id_tagihan]'");
										while ($data = mysql_fetch_array($sql)) {
									 ?>
									 <tr>
									 	<td scope="col" class="text-center"><?php echo $data['id_pembayaran'] ?></td>
									 	<td scope="col" class="text-center"><?php echo $data['id_tagihan'] ?></td>
									 	<td scope="col" class="text-right">Rp. <?php echo $data['denda_keterlambatan'] ?></td>
									 	<td scope="col" class="text-center"><?php echo substr($data['tanggal'], 0, 10) ?></td>
									 	<td scope="col" class="text-right">Rp. <?php echo $data['biaya_admin'] ?></td>
									 	<td scope="col" class="text-center"><?php echo $data['atas_nama'] ?></td>
									 	<td scope="col" class="text-center"><?php echo $data['no_rekening'] ?></td>
									 	<td scope="col" class="text-center"><img src="../foto/bukti_pembayaran/<?php echo "$data[bukti_pembayaran]" ?>" width="200"></td>
									 	<td scope="col" class="text-center"><?php echo $data['status'] ?></td>
									 	<td scope="col" class="text-center">
									 		<?php if ($data['status'] == "Terverifikasi"): ?>
									 			<a href="struk.php?id_pembayaran=<?php echo $data['id_pembayaran'] ?>&id_tagihan=<?php echo $data['id_tagihan'] ?>"><span class="oi oi-print"></span></a>
									 		<?php endif ?>
									 	</td>
									 </tr>
									 <?php 
										} 
									} 
									 ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>