<?php 
	$hari = date("d");
	$bulan = date("m");
	$tahun = date("Y");
	$tanggal = date("Y-m-d");
	$id_pembayaran = "PM".date("YmdHis");
	@$alamatfile = $_FILES['foto']['tmp_name'];
	@$namafile = $_FILES['foto']['name'];
	@$jenisfile = $_FILES['foto']['type'];
	$sql_tagihan = mysql_query("SELECT * FROM tbl_tagihan WHERE id_tagihan = '$_GET[id]'");
	$tagihan = mysql_fetch_array($sql_tagihan);
	$sql_pelanggan = mysql_query("SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$tagihan[id_pelanggan]'");
	$pelanggan = mysql_fetch_array($sql_pelanggan);
	$sql_tarif = mysql_query("SELECT * FROM tbl_tarif WHERE id_tarif = '$pelanggan[id_tarif]'");
	$tarif = mysql_fetch_array($sql_tarif);
 ?>
<body>
	<form method="post" enctype="multipart/form-data">
		<div class="row justify-content-md-center">
			<div class="col-md-auto align-items-center">
				<div class="card" style="margin-top:5%">
					<div class="card-header badge-primary">
						<center>Pembayaran Listrik</center>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-auto">
								<div class="form-title">
									<h3><strong>1</strong> Data Diri</h3>
								</div>
								<div class="step">
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>Id Pelanggan</label>
												<input class="form-control" name="id_pelanggan" value="<?php echo $pelanggan['id_pelanggan'] ?>" disabled required>
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>Nomor Meter</label>
												<input class="form-control" name="no_meter" value="<?php echo $pelanggan['no_meter'] ?>" disabled required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>Nama</label>
												<input class="form-control" name="nama" value="<?php echo $pelanggan['nama'] ?>"  disabled required>
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>Alamat</label>
												<textarea class="form-control" name="alamat" rows="auto" selected disabled><?php echo $pelanggan['alamat'] ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form_title">
									<h3><strong>2</strong> Informasi Tagihan</h3>
								</div>
								<div class="step">
									<table class="table table-striped cart-list add_bottom_30" style="font-size:12px;">
							            <thead>
						                	<th scope="col" class="text-center">Id Tagihan</th>
						                	<th scope="col" class="text-center">Id Pelanggan</th>
							                <th scope="col" class="text-center">Bulan</th>
							                <th scope="col" class="text-center">Tahun</th>
							                <th scope="col" class="text-center">Jumlah Meter</th>
							                <th scope="col" class="text-center">Status</th>
							                <th scope="col" class="text-center">Tagihan</th>
							                <th scope="col" class="text-center">Total Tagihan</th>
								        </thead>
	            						<tbody>
								            <tr>
								            	<td scope="col" class="text-center"><?php echo $tagihan['id_tagihan']  ?></td>
								            	<td scope="col" class="text-center"><?php echo $tagihan['id_pelanggan']  ?></td>
								            	<td scope="col" class="text-center"><?php echo $tagihan['bulan']  ?></td>
								            	<td scope="col" class="text-center"><?php echo $tagihan['tahun']  ?></td>
								            	<td scope="col" class="text-center"><?php echo $tagihan['jumlah_meter'] ?>/Kwh</td>
								            	<td scope="col" class="text-center"><?php echo $tagihan['status']  ?></td>
								            	<?php 
								            		$cek_bulan = $tagihan['bulan'] + 1;
								            	 ?>
								            	<?php if ($tahun > $tagihan['tahun']): ?>
								            		<?php 
								            			$bulan = $bulan + 12;
								            			$tunggak_bulan = $bulan - $cek_bulan;
								            			$denda = $tarif['denda_keterlambatan'] * $tunggak_bulan;
								            			$total_tagihan = $tagihan['total_tagihan'] + $denda + 2000;
								            		 ?>
								            		 <td scope="col" class="text-center">Rp. <?php echo $tagihan['total_tagihan']  ?> + Rp. <?php echo $denda ?>(Denda Keterlambatan selama <?php echo $tunggak_bulan ?> bulan) + Rp. 2000(Biaya Admin)</td>
									            <?php else: ?>
									            	<?php if ($bulan > $cek_bulan): ?>
									            		<?php
									            			$tunggak_bulan = $bulan - $cek_bulan;
									            			$denda = $tarif['denda_keterlambatan'] * $tunggak_bulan;
									            			$total_tagihan = $tagihan['total_tagihan'] + $tarif['denda_keterlambatan'] + 2000;
									            		 ?>
									            		<td scope="col" class="text-center">Rp. <?php echo $tagihan['total_tagihan']  ?> + Rp. <?php echo $tarif['denda_keterlambatan'] ?>(Denda Keterlambatan) + Rp. 2000(Biaya Admin)</td>
									            	<?php else: ?>
														<?php if($hari > 20): ?>
									           			<?php 
									            			$total_tagihan = $tagihan['total_tagihan'] + $tarif['denda_keterlambatan'] + 2000;
									            		 ?>
									            		<td scope="col" class="text-center">Rp. <?php echo $tagihan['total_tagihan']  ?> + Rp. <?php echo $tarif['denda_keterlambatan'] ?>(Denda Keterlambatan) + Rp. 2000(Biaya Admin)</td>
										            	<?php else: ?>
										            		<?php 
										            			$denda = 0;
										            			$total_tagihan = $tagihan['total_tagihan'] + 2000;
										            		 ?>
										            		<td scope="col" class="text-center">Rp. <?php echo $tagihan['total_tagihan']  ?> + Rp. 2000(Biaya Admin)</td>
										            	<?php endif ?>
										            <?php endif ?>
								            	<?php endif ?>
								            	<td scope="col" class="text-center"><strong>Rp. <?php echo $total_tagihan ?></strong></td>
								            </tr>
	            						</tbody>
	            
	            					</table>
								</div>
				
								<div class="form_title">
									<h3><strong>3</strong> Informasi Transfer</h3>
								</div>
								<div class="step">
									<label> Silahkan transfer ke rekening kami yang sudah tertera dibawah : </label>
									<div class="row">
										<div class="form-group">
											<img src="../foto/bank/bni.png" width="200px" height="100px">
											<br>
											<label class="offset-4 text-muted">1035870395</label>
											<br>
											<label class="offset-3 text-muted">Atas nama PLN</label>
										</div>
										<div class="form-group offset-1">
											<img src="../foto/bank/bri.png" width="100px" height="100px">
											<br>
											<label class="offset-1 text-muted">1232076355</label>
											<br>
											<label class="text-muted">Atas nama PLN</label>
										</div>
										<div class="form-group offset-1">
											<img src="../foto/bank/btn.png" width="200px" height="100px">
											<br>
											<label class="offset-3 text-muted"">1526721260</label>
											<br>
											<label class="offset-3 text-muted">Atas nama PLN</label>
										</div>
										<div class="form-group offset-1">
											<img src="../foto/bank/mandiri.png" width="100px" height="100px">
											<br>
											<label class="text-muted">1462800852</label>
											<br>
											<label class="text-muted">Atas nama PLN</label>
										</div>
									</div>
								</div>

								<div class="form_title">
									<h3><strong>4</strong> Informasi Pembayaran</h3>
								</div>
								<div class="step">
									<div class="form-group">
										<label>Atas Nama</label>
										<input type="text" class="form-control" name="atas_nama" maxlength="50" required>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>Nomor Rekening</label>
												<input type="text" class="form-control" name="no_rekening" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="20" required>
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
					                        <div class="form-group">
					                            <label>Bukti Pembayaran(Foto)</label>
					                           	<input type="file" class="form-control" name="foto" accept="image/*" required>
					                        </div>
					                    </div>
									</div>
									<?php 
										if (isset($_POST['bayar'])) {
											if ($tahun > $tagihan['tahun']) { 
									    		@move_uploaded_file($alamatfile, "../foto/bukti_pembayaran/$namafile");
												$sql1 = mysql_query("INSERT INTO tbl_pembayaran VALUES('$id_pembayaran', '$_GET[id]', '$tanggal', '$denda', '2000', '$total_tagihan', '$total_tagihan' '$_POST[atas_nama]', '$_POST[no_rekening]', '$namafile', 'Belum Terverifikasi')");
												$sql2 = mysql_query("UPDATE tbl_tagihan SET status = 'Belum' WHERE id_tagihan = '$_GET[id]'");
									   			if ($sql1 && $sql2) {
													echo "<script>alert('Data berhasil dikirim !');document.location.href='?menu=pembayaran'</script>";
												} else {
													echo mysql_error();
												}
									    	} else {
									    		if ($bulan > $cek_bulan) {
									    		 	@move_uploaded_file($alamatfile, "../foto/bukti_pembayaran/bukti_pembayaran/$namafile");
													$sql1 = mysql_query("INSERT INTO tbl_pembayaran VALUES('$id_pembayaran', '$_GET[id]', $tanggal, '$denda', '2000', '$total_tagihan', '$total_tagihan' '$_POST[atas_nama]', '$_POST[no_rekening]', '$namafile', 'Belum Terverifikasi')");
													$sql2 = mysql_query("UPDATE tbl_tagihan SET status = 'Belum' WHERE id_tagihan = '$_GET[id]'");
										   			if ($sql1 && $sql2) {
														echo "<script>alert('Data berhasil dikirim !');document.location.href='?menu=pembayaran'</script>";
													} else {
														echo mysql_error();
													}
									    		 } else {
									    		 	if ($hari > 20) {
									    		 		@move_uploaded_file($alamatfile, "../foto/bukti_pembayaran/$namafile");
														$sql1 = mysql_query("INSERT INTO tbl_pembayaran VALUES('$id_pembayaran', '$_GET[id]', $tanggal, '$denda', '2000', '$total_tagihan', '$_POST[atas_nama]', '$_POST[no_rekening]', '$namafile', 'Belum Terverifikasi')");
														$sql2 = mysql_query("UPDATE tbl_tagihan SET status = 'Belum' WHERE id_tagihan = '$_GET[id]'");
											   			if ($sql1 && $sql2) {
															echo "<script>alert('Data berhasil dikirim !');document.location.href='?menu=pembayaran'</script>";
														} else {
															echo mysql_error();
														}
									    		 	} else {
									    		 		@move_uploaded_file($alamatfile, "../foto/bukti_pembayaran/$namafile");
														$sql1 = mysql_query("INSERT INTO tbl_pembayaran VALUES('$id_pembayaran', '$_GET[id]', $tanggal, '$denda', '2000', '$total_tagihan', '$_POST[atas_nama]', '$_POST[no_rekening]', '$namafile', 'Belum Terverifikasi')");		
														$sql2 = mysql_query("UPDATE tbl_tagihan SET status = 'Belum' WHERE id_tagihan = '$_GET[id]'");
														if ($sql1 && $sql2) {
															echo "<script>alert('Data berhasil dikirim !');document.location.href='?menu=pembayaran'</script>";
														} else {
															echo mysql_error();
														}
									    		 	}
												}
									    	}
										}
									 ?>
									<div class="form-group">
										<button class="btn btn-primary" name="bayar">Bayar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>