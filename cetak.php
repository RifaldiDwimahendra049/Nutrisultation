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

require_once('vendor/autoload.php');

$mpdf = new\Mpdf\Mpdf();

ob_start();

$connect=mysqli_connect('localhost','root','','nutrisultation');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$result=mysqli_query($connect,"SELECT * FROM konsultasi WHERE id=$id");
$item=mysqli_fetch_assoc($result);

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
    $tanggal=date('d F Y');

    $ekor=substr($kode, 11,3);

    $nomor=$ekor."/nst22/cln/".date('Y');

    $nama_file="Hasil konsultasi ".$username;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hasil konsultasi <?php echo $username ?></title>
	<link rel="stylesheet" type="text/css" href="assets/css/stylee1.css">
</head>
<body>

<section  class="home">

	<table class="table1">
		<tr>
			<th colspan="5"><div class="logo_wrap"><a href="#" class="logo"><img class="logo-img" src="pict/health.png" >Nutri<span>sultation</span></a></div></th>
		</tr>

		<tr >
			<td  height="20px"></td>
			
		</tr>

		<tr>
			<th colspan="5">SURAT HASIL KONSULTASI</th>
		</tr>

		<tr>
			<td colspan="5" align="center">Nomor : <?php echo $nomor ?></td>
		</tr>

		<tr >
			<td  height="50px"></td>
			
		</tr>

		<tr>
			<td width="160px">Nomor Konsultasi</td>
			<td  width="10px">:</td>
			<td colspan="3"><?php echo $kode;?></td>
		</tr>

		<tr>
			<td>Nama</td>
			<td  width="10px">:</td>
			<td colspan="3"><?php echo $username;?> </td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td  width="10px">:</td>
			<td colspan="3"><?php echo $jenis_kelamin;?> </td>
		</tr>
		<tr>
			<td>Umur</td>
			<td  width="10px">:</td>
			<td colspan="3"> <?php echo $umur;?> Tahun</td>
		</tr>

		<tr>
			<td>Tinggi badan</td>
			<td  width="10px">:</td>
			<td colspan="3"><?php echo $tinggi;?> CM</td>
		</tr>

		<tr>
			<td>berat badan</td>
			<td  width="10px">:</td>
			<td colspan="3"><?php echo $berat;?> KG</td>
		</tr>

		<tr>
			<td>Dioagnosis</td>
			<td  width="10px">:</td>
			<td colspan="3" align="justify"> <?php echo $diagnosa;?></td>
		</tr>

		<tr>
			<td>Saran </td>
			<td  width="10px">:</td>
			<td colspan="3" align="justify"> <?php echo $saran;?> </td>
		</tr>

		<tr >
			<td  height="50px"></td>
			
		</tr>

		<tr>
			<td> </td>
			<td colspan="2"> </td>
			<td></td>
			<td class="isi"><?php echo $tanggal;?></td>
		</tr>

		<tr>
			<td> </td>
			<td colspan=2> </td>
			<td></td>
			<td class="isi">Nutrisionist :</td>
		</tr>

		<tr>
			<td> </td>
			<td colspan="2"> </td>
			<td></td>
			<td class="isi"><?php echo $nutrisionist;?></td>
		</tr>

	</table>
</section>


<?php
$html=ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("".$nama_file.".pdf",'I');
?>

</body>
</html>