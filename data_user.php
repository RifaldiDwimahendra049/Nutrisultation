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

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data User</title>
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
					<li class="active"><a class="hidup" href="data_user.php">Data User</a></li>
					<li><a href="konsultasi_admin.php">Data Konsultasi</a></li>
					<li><a href="pesan.php">Pesan</a></li>
				</ul>
			</div>

			<?php $batas = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman >1 ) ? ($halaman * $batas)-$batas : 0;

            $sebelumnya = $halaman - 1;
            $selanjutnya = $halaman + 1;

            $data = mysqli_query($connect,"SELECT * FROM user");
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);

            if (!isset ($_GET['cari'])) {

                    $data_user = mysqli_query($connect,"SELECT * FROM user LIMIT $halaman_awal, $batas ");
            }else{

            	$cari=$_GET['cari'];

            	 $data_user=mysqli_query($connect,"SELECT * FROM user WHERE username LIKE '%".$cari."%'
                            OR status LIKE '%".$cari."%' OR email LIKE '%".$cari."%' OR jenis_kelamin LIKE '%".$cari."%' "); 
                   

            }
            ?>

			<div class="isi-data">
				<a class="btn-iya" href="tambah_user.php">Tambah user</a>

				<h2 class="heading">Data User</h2>
			<form action="" method="GET" class="form-cari" >
                            <div class="cari">
                                <input type="text" class="input-cari" placeholder="Cari" name="cari">
                                <button class="btn-cari" type="submit">Cari</button>
                            </div>
                        </form>
				<table class="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>E-mail</th>
							<th>Jenis Kelamin</th>
							<th>Status</th>
							<th colspan="2">opsi</th>
						</tr>
					</thead>
 					<?php
                       if (!$data_user-> num_rows>0) {?>

                                    <tr >
                                            <td colspan="7"><b>Data Tidak Ditemukan</b></td>
                                        </tr>

                                <?php }else{?>
                                <tbody>
                                    <?php
                                    $no = 1 + $halaman_awal ;
                                    foreach ($data_user as $key => $item) :
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $item['username']; ?></td>
                                            <td><?= $item['email']; ?></td>
                                            <td><?= $item['jenis_kelamin']; ?></td>
                                            <td><?= $item['status']; ?></td>
                                            <td><a href="data_user_edit.php?id=<?php echo $item['id']?>" class="btn-ubah">Ubah</a></td>
                                             <td><a href="data_user_hapus.php?id=<?php echo $item['id']?>" onclick="return confirm('Yakin menghapus data?')" class="btn-hapus">Hapus</a></td>
                                        </tr>
                                    <?php $no++;
                                    endforeach; 

                                }?>
                               </tbody>
					
				</table>
                            <ul class="pagination" >
                            	<div class="pag-wrap">
                            <li class="page-item">
                                    <a  <?php if ($halaman > 1) : ?>href="?halaman=<?= $sebelumnya; ?>"<?php endif;?>>Sebelumnya</a>
                                </li>
                                <?php for ($nomor_halaman = 1; $nomor_halaman <= $total_halaman; $nomor_halaman++) : ?> 
                                <li class="page-item">
                                        <a href="?halaman=<?= $nomor_halaman; ?>"><?=$nomor_halaman;?></a>
                                </li>
                                <?php endfor;?>
                                <li class="page-item">
                                     <a  <?php if ($halaman<$total_halaman) : ?> href="?halaman=<?= $selanjutnya; ?>"<?php endif;?>>Selanjutnya</a>
                                </li>
                            	</div>
                            </ul>
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
	<p class="copyright" align="center">?? 2022 Nutrisultation. All Rights Reserved</p>
</footer>
<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>