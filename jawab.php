

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
    $id=$_GET['id'];

    $connect=mysqli_connect('localhost','root','','nutrisultation');

    $data=mysqli_query($connect,"SELECT *FROM bantuan WHERE id='$id'");
    $item=mysqli_fetch_assoc($data);
        $id=$item['id'];
        $username= $item['username'];
        $email= $item['email'];
        $pesan=$item['pesan'];
        $jawabi=$item['jawaban'];
        $kosong="n/a";

        if($jawabi==$kosong){
            $jawaban="";
        }else{
            $jawaban=$item['jawaban'];
        }


    if (isset($_POST['jawab'])) {
        
        
        $keluhan=$_POST['keluhan'];
        $pola_konsumsi=$_POST['pola_konsumsi'];

        if (empty($_POST['jawaban'])) {
            $errJawaban = "Pesan Tidak Boleh Kosong";
        } else {
            $errJawaban = "";
        }

        if ( $errJawaban == "") {

            $username= $_POST['username'];
            $email= $_POST['email'];
            $pesan=$_POST['pesan'];
            $jawaban=$_POST['jawaban'];
            
            $result = mysqli_query($connect, "UPDATE bantuan SET jawaban='$jawaban' WHERE id='$id'");
                        
                        if($result) {
                            $success="Jawaban terkirim";

                            header('location:pesan.php');
                        }else{
                            $errors="Jawaban Gagal Terkirim";
                        }

                    }else{
                        $errors="Gagal Terkirim";
                    }

                }

                error_reporting(0);
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
                    <li><a href="data_user.php">Data User</a></li>
                    <li><a href="konsultasi_admin.php">Data Konsultasi</a></li>
                    <li class="active"><a class="hidup" href="pesan.php">Pesan</a></li>
                </ul>
            </div>

            <div class="isi-form">

                <h2 class="heading">Jawab Pesan</h2>
            
                <form name="jawab" method="post">
                            <div class="row gy-3 gy-4">
                                <div class="data">
                                   
                                    <br>
                                    <span class="alern"><?=$errors ?></span>
                                    <span  class="success"><?=$success ?></span>


                                    <input readonly type="text"placeholder="Nama" name="username" value="<?= $username; ?>">
                               
                                    <input readonly type="text" placeholder="E-Mail" name="email" value="<?php echo $email; ?>">


                                    <textarea readonly name="pesan" placeholder="Pesan / Pertanyaan" ><?php echo $pesan; ?></textarea>

                                    <textarea  name="jawaban" placeholder="jawaban" ><?php echo $jawaban; ?></textarea>
                                    <span class="alern"><?= $errJawaban ?></span>

                                    <input type="hidden"placeholder="Nama" name="id" value="<?= $id; ?>">

                                <div class="button">
                                    <button type="submit" name="jawab" class="btn-iya">Kirim</button>
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