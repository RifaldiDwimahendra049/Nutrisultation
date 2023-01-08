<?php  
 
$connect = mysqli_connect('localhost', 'root', '', 'nutrisultation');

if (!$connect) {
    echo "<script>alert('Gagal tersambung dengan database.')</script>";
}

error_reporting(0);

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

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
 if ($errEmail == "" && $errPassword == "") {
    $data_user = mysqli_query($connect, "SELECT * FROM user WHERE email='$email' AND password='$password'");
    $cari = mysqli_num_rows($data_user);
    $result=mysqli_fetch_array($data_user);
    $status=mysqli_fetch_assoc($data_user);

    $admin="admin";
    $client="client";
    $nutrisionist="nutrisionist";

    if ($cari > 0) {
        if ($result['status']=="$client") {
            session_start();
            $_SESSION['login']=true;
            $_SESSION['email'] = $result['email'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['jenis_kelamin'] =$result['jenis_kelamin'];
            $_SESSION['status']=$result['status'];
            header("location:client_dashboard.php");

        }
        elseif ($result['status']=="$admin") {
            session_start();
            $_SESSION['login']=true;
            $_SESSION['email'] = $result['email'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['jenis_kelamin'] = $result['jenis_kelamin'];
            $_SESSION['status']=$result['status'];
            header('location:admin_dashboard.php');
        }elseif($result['status']=="nutrisionist"){
            session_start();
            $_SESSION['login']=true;
            $_SESSION['email'] = $result['email'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['jenis_kelamin'];
            $_SESSION['status']=$result['status'];
            header('location:nutrisionist_dashboard.php');
        }else{
            $errors="Password dan E-mail salah, Mohon periksa kembali";
        }
    } else {
        $errors="Password dan E-mail salah, Mohon periksa kembali";
    }

}
}

 
error_reporting(0);
 
?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <section class="registrasi">
        <div class="reg-head">
        <h1 class="logo"><img class="logo-img" src="pict/health.png">Nutri<span>sultation</span></h1><a href="index.php"><img class="logo-img" src="pict/close.png"></a>
    </div>
    <div class="regist-konten">
        <h1 class="title">Sign In</h1>
        <div class="sub-title">Perhatikan <b>Email</b> dan <b>Password</b> yang anda masukkan...
            <br/> Belum memiliki akun ? <a href="registrasi.php"> Daftar sekarang..</a></div>
    </div>
    <div class="form-wrap">
         <form action="" method="POST">
            <div class="Form">
                <br>
                <div class="input">

                    <span class="alern"><?= $errors ?></span>
                    <input autofocus type="email" placeholder="E-Mail" name="email" value="<?php echo $email;?>" >
                    <span class="alern"><?= $errEmail ?></span>
                    <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" >
                    <span class="alern"><?= $errPassword ?></span>
                </div>
                <div class="autocode">
                    <button name="submit" class="btn">Log In</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
</body>
</html>