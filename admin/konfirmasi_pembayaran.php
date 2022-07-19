<?php 
	if (isset($_GET['verifikasi'])) {
		$sql1 = mysql_query("UPDATE tbl_tagihan SET status = 'Sudah' WHERE id_tagihan = '$_GET[id]'");
		$sql2 = mysql_query("UPDATE tbl_pembayaran SET status = 'Terverifikasi' WHERE id_tagihan = '$_GET[id]'");
		
		if ($sql1 && $sql2) {
			echo "<script>alert('Pembayaran telah terverifikasi !');document.location.href='?menu=konfirmasi_pembayaran'</script>";
		} else {
			echo mysql_error();
		}
	}

	if (isset($_GET['tolak'])) {
		$sql1 = mysql_query("UPDATE tbl_tagihan SET status = 'Belum' WHERE id_tagihan = '$_GET[id]'");
		$sql2 = mysql_query("UPDATE tbl_pembayaran SET status = 'Ditolak' WHERE id_tagihan = '$_GET[id]'");

		if ($sql1 && $sql2) {
			echo "<script>alert('Pembayaran ditolak !');document.location.href='?menu=konfirmasi_pembayaran'</script>";
		}
	}
 ?>
<body>
	<form method="post">
		<div class="row justify-content-md-center">
			<div class="col-md-12 align-items-center">
				<br>
				<div class="card">
					<div class="card-header badge-primary">
						<center><span class="oi oi-check"></span> Konfirmasi Pembayaran</center>
					</div>
					<div class="card-body">
						<table class="table table-hover" id="data" align="center">
							<thead>
								<tr>
									<th scope="col" class="text-center">Id Pembayaran</th>
									<th scope="col" class="text-center">Id Tagihan</th>
									<th scope="col" class="text-center">Denda</th>
									<th scope="col" class="text-center">Biaya Admin</th>
									<th scope="col" class="text-center">Total Pembayaran</th>
									<th scope="col" class="text-center">Tanggal</th>
									<th scope="col" class="text-center">Atas Nama</th>
									<th scope="col" class="text-center">No rekening</th>
									<th scope="col" class="text-center">Bukti_pembayaran</th>
									<th scope="col" class="text-center">Status</th>
									<th scope="col" class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql = mysql_query("SELECT * FROM tbl_pembayaran WHERE status = 'Belum Terverifikasi'");
									while ($data = mysql_fetch_array($sql)) {
								 ?>
								 <tr>
								 	<td scope="col" class="text-center"><?php echo $data['id_pembayaran'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['id_tagihan'] ?></td>
								 	<td scope="col" class="text-center">Rp. <?php echo number_format($data['denda_keterlambatan'], '0', '', '.') ?></td>
								 	<td scope="col" class="text-center">Rp. <?php echo number_format($data['biaya_admin'], '0', '', '.') ?></td>
								 	<td scope="col" class="text-center">Rp. <?php echo number_format($data['total_pembayaran'], '0', '', '.') ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['tanggal'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['atas_nama'] ?></td>
								 	<td scope="col" class="text-center"><?php echo $data['no_rekening'] ?></td>
								 	<td scope="col" class="text-center"><img src="../foto/bukti_pembayaran/<?php echo "$data[bukti_pembayaran]" ?>" width="200"></td>
								 	<td scope="col" class="text-center"><?php echo $data['status'] ?></td>
								 	<td scope="col" class="text-center"><a href="?menu=konfirmasi_pembayaran&verifikasi&id=<?php echo $data['id_tagihan'] ?>"><span class="oi oi-circle-check"></span></a> <a href="?menu=konfirmasi_pembayaran&tolak&id=<?php echo $data['id_tagihan'] ?>" class="offset-3"><span class="oi oi-circle-x"></span></a>
								 	 </td>
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