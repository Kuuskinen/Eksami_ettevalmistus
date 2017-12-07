<?php
	require("functions.php");
	require("classes/Photoupload.class.php");
	$notice = "";
	
	//kui pole sisseloginud, siis sisselogimise lehele
	/*if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}*/
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login.php");
	}
	//klassi esimene näide
	/*$esimene = new Photoupload("kaval trikk. ");
	echo $esimene->testPublic;
	//echo $esimene->testPrivate;
	$teine = new Photoupload("ja nii jub mitu korda");*/
	
	
	
	//Algab foto laadimise osa
	$target_dir = "pics/";
	$target_file = "";
	$uploadOk = 1;
	$maxWidth = 600;
	$maxHeight = 400;
	$marginHor = 10;
	$marginVer = 10;
		
	//kas vajutati laadimise nuppu
	if(isset($_POST["submit"])) {
		//kas fail on valitud, failinimi olemas
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			//fikseerin failinime
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
			//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			//$target_file = $target_dir .pathinfo(basename($FILES_
			$target_file = "hmv_" .(microtime(1) * 10000) ."." .$imageFileType;
			
			//Kas on pildi failitüüp
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "See pole pildifail. ";
				$uploadOk = 0;
			}
			
			//Kas selline pilt on juba üles laetud
			/*if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}*///kuna time stamp on juba olemas ja ei saa olla samasugust pilit
			//Piirame faili suuruse
			if ($_FILES["fileToUpload"]["size"] > 1000000) {
				$notice .= "Pilt on liiga suur! ";
				$uploadOk = 0;
			}
			
			//Piirame failitüüpe
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$notice .= "Vabandust, vaid jpg, jpeg, png ja gif failid on lubatud! ";
				$uploadOk = 0;
			}
			
			//Kas saab laadida?
			if ($uploadOk == 0) {
				$notice .= "Vabandust, pilti ei laetud üles! ";
			//Kui saab üles laadida
			} else {// pildi laadimine klassi abil
				$myPhoto=new Photoupload($_FILES["fileToUpload"]["tmp_name"], $imageFileType);
				$myPhoto->rezisePhoto($maxWidth, $maxHeight);
				$myPhoto->addwatermark("../../graphics/hmv_logo.png", $marginHor, $marginVer);
				$myPhoto->addTextWatermark("Lõbusad pildid");
				$notice=$myPhoto->savePhoto($target_dir, $target_file);
				//$mtPhoto->saveOriginal($target_dir, $file_file);
				$myPhoto->clearImages();
				
				
				unset($myPhoto);//muutujalt võetakse väärtus ära.  Unustatakse mis classiga seotud		
			}
		} else {
			$notice = "Palun valige kõigepealt pildifail!";
		}
	} //if submit lõppeb
	
	/*function resizeImage($image, $origW, $origH, $w, $h){
		$newImage = imagecreatetruecolor($w, $h);
		//kuhu, kust, kuhu koordinaatidele x ja y, kust koordinaatidelt x ja y, kui laialt uude kohta, kui kõrgelt uude kohta, kui laialt võtta, kui kõrgelt võtta
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $w, $h, $origW, $origH);
		return $newImage;
	}*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pildi üleslaadimine</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="bg-secondary">
<div class="container bg-secondary">
<nav class="navbar navbar_inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"</a>
		</div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="main.php">Kodu</a></li>
      <li><a href="foto.php">Pildid</a></li>
	  <li><a href="usersInfo.php">Kasutajate andmed</a></li>
	  <li><a href="?logout=1">Logi välja</a></li>
    </ul>
  </div>
</nav>
  

 

	<h1>Pildi üleslaadimine</h1>
	
	<!--<p><a href="?logout=1">Logi välja</a>!</p>-->
	<!--<p><a href="main.php">Pealeht</a></p>-->
	
	 
	
	<hr>
	
	<form action="photoupload.php" method="post" enctype="multipart/form-data">
		<label>Valige pildifail:</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Lae üles" name="submit">
	</form>
	
	<span><?php echo $notice; ?></span>
	<hr>
	</div>
</body>
</html>