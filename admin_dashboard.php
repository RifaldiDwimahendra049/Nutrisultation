<?php
	session_start();

	if (!isset($_SESSION['login'])) {
		header("location:login.php");
		exit();
	}

	$status=$_SESSION['status'];
	$admin="admin";
	if  ($status!=$admin){
		echo "<script>
			window.location=history.go(-1);
		</script>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<header>
		<nav class="navbar">
				<div class="container nav-wrapper">					
					<div class="logo-wrap">
						<a href="#" class="logo"><img class="logo-img" src="pict/health.png" >Nutri<span>sultation</span></a>
					</div>
					<div class="toggle">
						<input type="checkbox" />
						<img src="pict/account.png" width="50px">
					</div>
				</div>
		</nav>

		<div class="profiles">
			<section>
				<?php echo $_SESSION['username'];?><br>
				<?php echo $_SESSION['email'];?><br><br>
				<a class="btn-iya"  href="ganti_pass.php">Ganti Password</a>
				<a class="btn-logout" style="align:center" onclick="return confirm('Yakin ingin Log-Out?')" href="logout.php">Log-Out</a>
				
		</section>
	</div>
	</header>
	<div class="dashboard">
			<div class="navi">
				<ul>
					<li class="active"><a class="hidup" href="admin_dashboard.php">Home</a></li>
					<li><a href="data_user.php">Data User</a></li>
					<li><a href="konsultasi_admin.php">Data Konsultasi</a></li>
					<li><a href="pesan.php">Pesan</a></li>
				</ul>
			</div>

			<div class="isi">
				<div class="isi-kiri">
					<h2 class="heading">Hallo, <?php echo $_SESSION['username'];?> :)</h2><br>
					Sebagai admin, anda memiliki hak untuk mengakses dan mengatur seluruh data pengguna dan data konsultasi.
					Sebagai admin, anda memiliki tugas untuk mengawasi, mengamankan, menjaga kerahasiaan data pengguna dan data konsultasi serta membantu pengguna dengan cara menjawab pertanyaan pengguna.  
				</div>
				<div class="isi-kanan">
						<img width="95%" src="pict/admin.png">
					</div>
			</div>

		</div>
		<footer>
	<section class="footer">
		<div class="footer-wrapper">
			<div class="footer-left">
				<h2 class="head">About <img src="pict/info.png"></h2>
				<ul class="foot">
					<li>Muhammad Rifaldi D</li>
					<li>F55120049</li>
					<li>Teknik Informatika</li>
					<li>Kelas B</li>
				</ul>
			</div>
			<div class="footer-right">
				<h2 class="head">Contact <img src="pict/contact.png"></h2>
				<ul class="foot">
					<li><img src="pict/phone.png">&nbsp;&nbsp;(+62)85392013134</li>
					<li><img src="pict/email.png">&nbsp; &nbsp;rfldi.mhdra512@gmail.com</li>
				</ul>
			</div>
		
		</div>
	</section>
	<p class="copyright" align="center">© 2022 Nutrisultation. All Rights Reserved</p>
</footer>
<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>