<?php
	session_start();

	if (!isset($_SESSION['login'])) {
		header("location:login.php");
		exit();
	}
	$status=$_SESSION['status'];
	$stat="client";
	if  ($status!=$stat){
		echo "<script>
			window.location=history.go(-1);
		</script>";
	}

	error_reporting(0);

$connect=mysqli_connect('localhost','root','','nutrisultation');

$query = mysqli_query($connect, "SELECT MAX(no_konsultasi) as nomor from konsultasi");
$data = mysqli_fetch_array($query);
$no_baru = $data['nomor'];
$urutan = substr($no_baru, 11, 3);
$urutan++;
$huruf = "konsultasi-";
$no_baru = $huruf . sprintf('%03s', $urutan);

	$username=$_SESSION['username'];
	$email=$_SESSION['email'];
	$jenis_kelamin=$_SESSION['jenis_kelamin'];




    if (isset($_POST['konsultasi'])) {

        $umur= $_POST['umur'];
        $tinggi=$_POST['tinggi'];
        $berat=$_POST['berat'];
        $keluhan=$_POST['keluhan'];
        $pola_konsumsi=$_POST['pola_konsumsi'];
        


 		 if (empty($_POST['umur'])) {
            $errUmur = "Data kosong";
        } elseif($umur< 0) {
            $errUmur = "Data invalid";   
        }else{
        	$errUmur="";
        }
        
        if (empty($berat)) {
        	$errBerat="Data kosong";
        }elseif ($tinggi < 45) {
        	$errBerat="Data invalid";
        }else{
        	$errBerat="";
        }

        if (empty($tinggi)) {
        	$errTinggi="Data kosong";
        }elseif ($tinggi < 45) {
        	$errTinggi="Data invalid";
        }else{
        	$errTinggi="";
        }

        if (empty($_POST['keluhan'])) {
            $errKeluhan = "Data Tidak Boleh Kosong";
        } else {
            $errKeluhan = "";
        }

        if(empty($_POST['pola_konsumsi'])){
        	$errPola="Data Tidak Boleh Kosong";
        }else{
        	$errPola="";
        }

        if ( $errUmur == "" && $errTinggi == "" && $errBerat == ""&& $errKeluhan==""&& $errPola=="") {
        	$kode = $_POST['kode'];
       		$username= $_POST['username'];
			$email= $_POST['email'];
			$jenis_kelamin=$_POST['jenis_kelamin'];
			$umur= $_POST['umur'];
        	$tinggi=$_POST['tinggi'];
        	$berat=$_POST['berat'];
        	$keluhan=$_POST['keluhan'];
        	$pola_konsumsi=$_POST['pola_konsumsi'];
			$nutrisionist=$_POST['nutrisionist'];
      		$email_nutrisionist=$_POST['email_nutrisionist'];
			$diagnosa=$_POST['diagnosa'];
			$saran=$_POST['saran'];
        	
        	$result = mysqli_query($connect, "INSERT INTO konsultasi(no_konsultasi, username, email, jenis_kelamin, umur, tinggi_badan, berat_badan, keluhan, pola_makan, nutrisionist, email_nutrisionist, diagnosa, saran_diet )
                    VALUES ('$kode', '$username', '$email','$jenis_kelamin', '$umur','$tinggi', '$berat', '$keluhan', '$pola_konsumsi', '$nutrisionist', '$email_nutrisionist','$diagnosa', '$saran')");
            			
            			if($result) {
            				$success="Data anda Telah terkirim";

            				$umur = "";
        					$tinggi = "";
        					$berat ="";
        					$keluhan = "";
        					$pola_konsumsi = "";
            			}else{
            				$errors="Data Tidak Terkirim";
            			}

            		}else{
            			$errors="Data Tidak Terkirim";
            		}


    error_reporting(0);   
  }   
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
				<a class="btn-iya"  href="ganti_pass_client.php">Ganti Password</a>
				<a class="btn-logout" style="align:center" onclick="return confirm('Yakin ingin Log-Out?')" href="logout.php">Log-Out</a>
				

				
		</section>
	</div>
	</header>
	<div class="dashboard">
			<div class="navi">
				<ul>
					<li><a href="client_dashboard.php">Home</a></li>
					<li class="active"><a class="hidup" href="konsultasi.php">Konsultasi</a></li>
					<li><a href="konsultasi_client.php">Data Konsultasi</a></li>
					<li><a href="help_client.php">Bantuan</a></li>
				</ul>
			</div>

			<div class="isi-form">
				<h2 class="heading">KONSULTASI</h2>
				<form name="konsultasi" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                   
                                    <br>
                                	<span class="alern"><?=$errors ?></span>
                                	<span  class="success"><?=$success ?></span>

                                	<input readonly type="text"placeholder="Kode Konsultasi" name="kode" value="<?= $no_baru; ?>">

                                    <input readonly type="text"placeholder="Nama" name="username" value="<?= $username; ?>">
                               
                                    <input  type="hidden" placeholder="E-Mail" name="email" value="<?php echo $email; ?>">

                                    <input readonly type="text" class="form-control" placeholder="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jenis_kelamin; ?>">

                                    <input type="number"placeholder="Umur (Tahun)" name="umur" value="<?= $umur; ?>">
                                    <span class="alern"><?= $errUmur ?></span>

                                    <div class="flexy">
                                    <div class="flex">
                                    <input type="number"  placeholder="Tinggi badan (CM)" name="tinggi" value=<?php echo $tinggi; ?>>
                                    <span class="alern"><?= $errTinggi ?></span>
                                    </div>
                                    <div class="flex">
                                    <input type="number" placeholder="Berat badan (KG)" name="berat" value=<?php echo $berat; ?>>
                                    <span class="alern"><?= $errBerat ?></span>
                                    </div>
                                    </div>

                                    <textarea name="keluhan" placeholder="Riwayat penyakit dan keluhan" ><?php echo $keluhan; ?></textarea>
                                    <span class="alern"><?= $errKeluhan ?></span>

                                    <textarea name="pola_konsumsi" placeholder="Pola konsumsi (makan)" ><?php echo $pola_konsumsi; ?></textarea>
                                    <span class="alern"><?= $errPola ?></span>

                                    <input  type="hidden" name="nutrisionist" value="n/a">
                                    <input  type="hidden" name="email_nutrisionist" value="n/a">
                                    <input  type="hidden" name="diagnosa" value="n/a">
                                    <input  type="hidden" name="saran" value="n/a">

                                <div class="button">
                                    <button type="submit" name="konsultasi" class="btn-iya">Konsultasi</button>
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