<?php
	session_start();

	if (!isset($_SESSION['login'])) {
		header("location:login.php");
		exit();
	}
	$status=$_SESSION['status'];
	$stat="nutrisionist";
	if  ($status!=$stat){
		echo "<script>
			window.location=history.go(-1);
		</script>";
	}


error_reporting(0);

	$connect=mysqli_connect('localhost','root','','nutrisultation');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$email=$_SESSION['email'];


$result = mysqli_query($connect, "SELECT * FROM user WHERE email='$email' ");
while ($item = mysqli_fetch_assoc($result)) {
	 $password = $item['password'];
    $errPassword = "";
    $errCpass="";
    $errOldPass ="";


    if(isset($_POST['batal'])){
    	header("location:nutrisionist_dashboard.php");
    }


    if (isset($_POST['update'])) {

        if (empty($_POST['oldpass'])) {
            $errOldPass = "Mohon, Masukkan password lama anda";
        } else {
            $errOldPass = "";
        }
        if (empty($_POST['newpassword'])) {
            $errPassword = "Data Tidak Boleh Kosong";
        } else {
            $errPassword = "";
        }
        if (empty($_POST['cpassword'])) {
            $errCpass = "Data Tidak Boleh Kosong";
        } else {
            $errCpass = "";
        }

        if ( $errPassword == ""&& $errCpass==""&& $errOldPass=="") {
        	
        	$oldpass = $_POST['oldpass'];
            $newpassword = $_POST['newpassword'];
            $cpassword = $_POST['cpassword'];

            if ($oldpass==$password) {

            	if ($newpassword==$cpassword) {
            			$result = mysqli_query($connect, "UPDATE user SET password='$newpassword' WHERE email='$email'");
            			
            			if($result) {
            				$success="Password berhasil di-ubah";

            				$oldpass="";
            				$newpassword="";
            				$cpassword="";
            			}


            		}else{
            		$errCpass = "Konfirmasi password salah";
            		}	
            }else{
            $errOldPass ="Password Salah";
            }

        }
	}
}

error_reporting(0);
     

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ubah Password</title>
	<link rel="stylesheet" type="text/css" href="assets/style7.css">
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
				<a class="btn-iya"  href="ganti_pass_nutri.php">Ganti Password</a>
				<a class="btn-logout" style="align:center" onclick="return confirm('Yakin ingin Log-Out?')" href="logout.php">Log-Out</a>
				

				
		</section>
	</div>
	</header>
	<div class="dashboard">
			<div class="navi">
				<ul>
					<li><a href="nutrisionist_dashboard.php">Home</a></li>
					<li ><a href="konsultasi_nutri.php">Konsultasi</a></li>
					<li><a href="hasil_konsul.php">Hasil Konsultasi</a></li>
					<li><a href="help.php">Bantuan</a></li>
				</ul>
			</div>

			<div class="isi-form">
				<h2 class="heading">Ubah Password</h2>
				<form name="update" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                   
                                    <span class="success"><?= $success ?></span>

                                    <input type="password" placeholder="Password Lama" name="oldpass" value="<?php echo $oldpass; ?>">
                                    <span class="alern"><?= $errOldPass ?></span>

                                    <input type="password" placeholder="Password Baru" name="newpassword" value="<?php echo $newpassword; ?>">
                                    <span class="alern"><?= $errPassword ?></span>

                                    <input type="password" placeholder="Konfirmasi Password" name="cpassword" value="<?php echo $cpassword; ?>">
                                    <span class="alern"><?= $errCpass ?></span>

                                <div class="button">
                                    <button type="submit" name="update" class="btn-iya">Ubah</button>
                                    <button type="submit" name="batal" class="btn-batal">Kembali</button>
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