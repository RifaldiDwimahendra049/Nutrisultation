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

	$connect=mysqli_connect('localhost','root','','nutrisultation');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result = mysqli_query($connect, "SELECT * FROM user WHERE id=$id");
 foreach ($result as $key => $item) {
    $username = $item['username'];
    $email = $item['email'];
    $password = $item['password'];
    $jenis_kelamin= $item['jenis_kelamin'];
    $status= $item['status'];

    $errUser = "";
    $errEmail = "";
    $errPassword = "";
    $errStatus="";
    $errJK="";

    $admin="admin";
    $client="client";
    $nutrisionist="nutrisionist";
    $laki="Laki-laki";
    $perempuan="Perempuan";

    if(isset($_POST['batal'])){
    	header("location:data_user.php");
    }


    if (isset($_POST['update'])) {

        if (empty($_POST['username'])) {
            $errUser = "Data Tidak Boleh Kosong";
        } else {
            $errUser = "";
        }

        if (empty($_POST['email'])) {
            $errEmail = "Data Tidak Boleh Kosong";
        } else {
            $errEmail = "";
        }
        if (empty($_POST['password'])) {
            $errPassword = "Data Tidak Boleh Kosong";
        } else {
            $errPassword = "";
        }
        if (empty($_POST['status'])) {
            $errStatus = "Data Tidak Boleh Kosong";
        } else {
            $errStatus = "";
        }

        if (empty($_POST['jenis_kelamin'])) {
            $errJK = "Data Tidak Boleh Kosong";
        } else {
            $errJK = "";
        }

        if ($errUser == "" && $errEmail == "" && $errPassword == ""&& $errStatus==""&& $errJK=="") {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $jenis_kelamin=$_POST['jenis_kelamin'];
            $password = $_POST['password'];
            $status = $_POST['status'];

            $result = mysqli_query($connect, "UPDATE user SET username='$username', email='$email',jenis_kelamin='$jenis_kelamin', password='$password',status='$status' WHERE id=$id");
           
            header("Location: data_user.php");


        }
    }
     

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Data User</title>
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
				<?php echo $_SESSION['status'];?><br>
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
					<li class="active"><a class="hidup" href="data_user.php">Data User</a></li>
					<li><a href="konsultasi_admin.php">Data Konsultasi</a></li>
					<li><a href="pesan.php">Pesan</a></li>
				</ul>
			</div>

			<div class="isi-form">
				<h2 class="heading">Edit Data User</h2>
				<form name="update" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                    <input type="text"placeholder="Nama" name="username" value="<?= $item['username']; ?>">
                                    <span class="alern"><?= $errUser ?></span>
                               
                                    <input  type="email" class="form-control" placeholder="E-Mail" name="email" value="<?php echo $email; ?>">
                                    <span class="alern"><?= $errEmail ?></span>
                                	
                                	<select name="jenis_kelamin" >
                                		<?php   if ($jenis_kelamin==$laki) {?>
                                		<option value="">--Pilih Jenis kelamin--</option>
                        				<option selected value="Laki-laki">Laki-laki</option>
                        				<option value="Perempuan">Perempuan</option>
                                		
                                		<?php }elseif($jenis_kelamin==$perempuan) { ?>
                                		<option value="">--Pilih Jenis kelamin--</option>
                        				<option value="Laki-laki">Laki-laki</option>
                        				<option selected value="Perempuan">Perempuan</option>
                                		<?php } else { ?>
                                		<option value="">--Pilih Jenis kelamin--</option>
                        				<option value="Laki-laki">Laki-laki</option>
                        				<option value="Perempuan">Perempuan</option>
                                		<?php } ?>
                                		
										
                     				</select>
                     				<span class="alern"><?=$errJK ?></span>


                                    <input type="text" class="form-control" placeholder="Password" name="password" value="<?php echo $password; ?>">
                                    <span class="alern"><?= $errPassword ?></span>
                               
                               		<select  name="status" >
                               			<?php if($status==$admin) { ?>
                               			<option value="">--Pilih status--</option>
                               			<option selected value="admin">admin</option>
                               			<option value="nutrisionist">nutrisionist</option>
                               			<option value="client">client</option>

                               			<?php }elseif($status==$nutrisionist){?>
                               			<option value="">--Pilih status--</option>
                               			<option value="admin">admin</option>
                               			<option selected value="nutrisionist">nutrisionist</option>
                               			<option value="client">client</option>

                               			<?php }elseif ($status==$client) {?>
                               			<option value="">--Pilih status--</option>
                               			<option value="admin">admin</option>
                               			<option value="nutrisionist">nutrisionist</option>
                               			<option selected value="client">client</option>
                               			<?php  }else{?>

                               			<option value="">--Pilih status--</option>
                               			<option value="admin">admin</option>
                               			<option value="nutrisionist">nutrisionist</option>
                               			<option  value="client">client</option>	
                               			<?php } ?>
                               		</select>
                               		
                                    <span class="alern"><?= $errStatus ?></span>
                                     <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
                                </div>

                                <div class="button">
                                    <button type="submit" name="update" class="btn-iya">Update</button>
                                    <button type="submit" name="batal" class="btn-batal">Batal</button>
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
					<li>Interaksi Manusia Komputer B</li>
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
<?php } ?>