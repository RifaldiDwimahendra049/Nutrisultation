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

	$username=$_SESSION['username'];
	$email=$_SESSION['email'];
	$jawab="n/a";



    if (isset($_POST['help'])) {

        if (empty($_POST['pesan'])) {
            $errPesan = "Pesan Tidak Boleh Kosong";
        } else {
            $errPesan = "";
        }

        if ( $errPesan == "") {

       		$username= $_POST['username'];
			$email= $_POST['email'];
			$pesan=$_POST['pesan'];
			$jawaban=$_POST['jawaban'];
        	
        	$result = mysqli_query($connect, "INSERT INTO bantuan(username, email, pesan, jawaban )
                    VALUES ('$username', '$email','$pesan', '$jawaban')");
            			
            			if($result) {
            				$success="Pesan anda telah terkirim";

            				$pesan = "";
            			}else{
            				$errors="Pesan Gagal Terkirim";
            			}

            		}else{
            			$errors="Pesan Gagal Terkirim";
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
					<li><a href="konsultasi.php">Konsultasi</a></li>
					<li><a href="konsultasi_client.php">Data Konsultasi</a></li>
					<li class="active"><a class="hidup" href="help_client.php">Bantuan</a></li>
				</ul>
			</div>

			<div class="isi-form">
				<a class="btn-iya" href="pesan_client.php">pesan anda</a>
				<h2 class="heading">Pesan / Pertanyaan</h2>
				<form name="konsultasi" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                   
                                    <br>
                                	<span class="alern"><?=$errors; ?></span>
                                	<span  class="success"><?=$success; ?></span>

                                    <input readonly type="text"placeholder="Nama" name="username" value="<?= $username; ?>">
                               
                                    <input readonly type="text" placeholder="E-Mail" name="email" value="<?php echo $email; ?>">


                                    <textarea name="pesan" placeholder="Pesan / Pertanyaan" ><?php echo $pesan; ?></textarea>
                                    <span class="alern"><?= $errPesan; ?></span>

                                    <input  type="hidden" name="jawaban" value="<?php echo $jawab; ?>">

                                <div class="button">
                                    <button type="submit" name="help" class="btn-iya">Kirim</button>
                                </div>
                            </div>
                        </form>
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