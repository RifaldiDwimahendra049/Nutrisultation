<?php
	session_start();

	if (!isset($_SESSION['login'])) {
		header("location:login.php");
		exit();
	}
	$status=$_SESSION['status'];
	$stat="admin";
	if  ($status!=$stat){
		echo "<script>
			window.location=history.go(-1);
		</script>";
	}

	error_reporting(0);

$connect=mysqli_connect('localhost','root','','nutrisultation');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result=mysqli_query($connect,"SELECT * FROM konsultasi WHERE id=$id");
$item=mysqli_fetch_assoc($result);

if(isset($_POST['kembali'])){
    	header("location:konsultasi_admin.php");
    }

			$kode = $item['no_konsultasi'];
       		$username= $item['username'];
			$jenis_kelamin=$item['jenis_kelamin'];
			$umur= $item['umur'];
        	$tinggi=$item['tinggi_badan'];
        	$berat=$item['berat_badan'];
        	$keluhan=$item['keluhan'];
        	$pola_konsumsi=$item['pola_makan'];
			$nutrisionist=$item['nutrisionist'];
			$diagnosa=$item['diagnosa'];
			$saran=$item['saran_diet'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Konsultasi</title>
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
					<li><a href="admin_dashboard.php">Home</a></li>
					<li ><a  href="data_user.php">Data User</a></li>
					<li><a href="konsultasi_admin.php">Data Konsultasi</a></li>
					<li><a href="pesan.php">Pesan</a></li>
				</ul>
			</div>

			<div class="isi-form">
				<h2 class="heading">Detail Konsultasi</h2>
				<form name="konsultasi" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                   
                                    <br>

                                	<input readonly type="text"placeholder="Kode Konsultasi" name="kode" value="<?= $kode; ?>">

                                    <input readonly type="text"placeholder="Nama" name="username" value="<?= $username; ?>">
                               
                                    <input  type="hidden" placeholder="E-Mail" name="email" value="<?php echo $email; ?>">

                                    <input readonly type="text" class="form-control" placeholder="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jenis_kelamin; ?>">

                                    <input readonly type="number"placeholder="Umur (Tahun)" name="umur" value="<?= $umur; ?>">

                                    <div class="flexy">
                                    <div class="flex">
                                    <input readonly type="number"  placeholder="Tinggi badan (CM)" name="tinggi" value="<?php echo $tinggi; ?>">
                                    </div>
                                    <div class="flex">
                                    <input readonly type="number" placeholder="Berat badan (KG)" name="berat" value="<?php echo $berat; ?>">
                                    </div>
                                    </div>

                                    <textarea readonly name="keluhan" placeholder="Keluhan" ><?php echo $keluhan; ?></textarea>

                                    <textarea readonly name="pola_konsumsi" placeholder="Pola konsumsi (makan)" ><?php echo $pola_konsumsi; ?></textarea>

                                    
                                    <input readonly  type="text" name="nutrisionist" value="<?php echo $nutrisionist ?>">
                                    
                                    <textarea readonly name="diagnosa"  ><?php echo $diagnosa; ?></textarea>

                                    <textarea readonly name="diagnosa"  ><?php echo $saran; ?></textarea>

                                    

                                <div class="button">
                                    <button type="submit" name="kembali" class="btn-batal">kembali</button>
                                </div>
                            </div>
                        </form></div>
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