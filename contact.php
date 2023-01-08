
<?php

$connect=mysqli_connect('localhost','root','','nutrisultation');

error_reporting(0);
	$jawab="n/a";

if (isset($_POST['help'])) {

        
        if (empty($_POST['username'])) {
            $errUser = "Masukkan nama anda";
        } else {
            $errUser = "";
        }
        
        if (empty($_POST['email'])) {
            $errEmail = "Masukkan E-mail anda";
        } else {
            $errEmail = "";
        }

        if (empty($_POST['pesan'])) {
            $errPesan = "Pesan Tidak Boleh Kosong";
        } else {
            $errPesan = "";
        }

        if ( $errUser == "" && $errEmail=="" && $errPesan=="") {

       		$username= $_POST['username'];
			$email= $_POST['email'];
			$pesan=$_POST['pesan'];
			$jawaban=$_POST['jawaban'];
        	
        	$result = mysqli_query($connect, "INSERT INTO bantuan(username, email, pesan, jawaban )
                    VALUES ('$username', '$email','$pesan', '$jawaban')");
            			
            			if($result) {
            				$success="Pesan anda telah terkirim";

            				$username="";
            				$email="";
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
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<header>
		<nav class="navbar">
				<div class="container nav-wrapper">
					<div class="logo-wrap">
					<a href="#" class="logo"><img class="logo-img" src="pict/health.png" >Nutri<span>sultation</span></a></div>
						<div class="menu-wrapper">
							<ul class="menu">
								<li class="menu-item"><a href="index.php" class="menu-link ">Home</a></li>
								<li class="menu-item"><a href="contact.php" class="menu-link active">About</a></li>
							</ul>
							<a href="login.php" class="btn-member">Sign In</a>
						</div>
				</div>
		</nav>
	</header>
		<section class="home" id="home">
			<div class="container home-wrapper">
				<div class="content-left">
					<h2 class="heading">We Care About Your Nutritions</h2>
				<p class="subheading">Kami mengutamakan kenyamanan anda dan ketepatan informasi yang anda dapatkan, karenanya kami bermitra dengan para ahli gizi bersertifikasi dan berkompeten.</p>
				<p class="subheading">Jadi, tunggu apa lagi?....
					Segera mulai konsultasi pertama anda bersama kami.</p>
				<a href="registrasi.php" class="reg">Mulai Konsultasi</a>
				</div>
				<div class="content-right">
					<h2 class="heading">Contact Us!</h2>
					<form name="konsultasi" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                   
                                    <br>
                                	<span class="alern"><?=$errors; ?></span>
                                	<span  class="success"><?=$success; ?></span>

                                    <input type="text"placeholder="Nama" name="username" value="<?= $username; ?>">
                                    <span class="alern"><?= $errUser; ?></span>
                               
                                    <input type="text" placeholder="E-Mail" name="email" value="<?php echo $email; ?>">
									<span class="alern"><?= $errEmail; ?></span>

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
		</section>
</body>
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
</html>