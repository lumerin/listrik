<?php 
	$admin = mysql_fetch_array(mysql_query("SELECT * FROM tbl_admin WHERE id_admin = '$_SESSION[username]'"));
 ?>
<body>
	<h1 style="margin-top: 15%"><marquee>Selamat Datang <strong><?php echo $admin['nama'] ?></strong> !</marquee></h1>
</body>