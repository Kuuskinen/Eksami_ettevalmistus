<?php
    //NB! Palun treppige koodi ning ärge jätke ebavajalikke tühikuid! Koodihügieen on sama oluline kui isiklik hügieen! Aitäh! Teie ML
	
	//et pääseks ligi sessioonile ja funktsioonidele
	require("functions.php");
	
	//kui pole loginud suunab login lehele SEE ON VÄLJAS, ET DEADLOCK EI TEKIKS!
	/*if(!isset($_SESSION["userid"])){
		header("Location: login.php");
		exit();
		}*/
	
	//unustatakse kasutajaga seotud sessioon
	if(isset($_GET["logout"])){ 
		session_destroy();                                             
		header("Location: login.php");
		exit();
	}
	
	//Muutujad
	$picDir = "../pics/";
	$picFiles = [];
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	
	$allFiles = array_slice (scandir($picDir), 2);
	foreach ($allFiles as $file){
		$fileType = pathinfo ($file,  PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);            
		}
	}
	
	//Var_dump($allFiles);
	//$picFiles = array_slice($allFiles, 2);
	//var_dump($picFiles);
	$picFileCount = count ($picFiles);
	$picNumber = mt_rand(0, $picFileCount - 1); // rand ja mt rand juhuslikus veel parem kiirem ja parem -1 soovitav ja lisa see
	$picFile = $picFiles[$picNumber];
	
?>	


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Kosmosefotod?
	</title
</head>
<body bgcolor=#BDBDBD>
    <h1>NASA kosmosefotod</h1>
	<h4>Sa oled sisselogitud kui: <?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?></h4> 
	<p>See veebileht on loodud tõsise õppetöö raames.</p>
	<p><a href="?logout=1">Logi välja</a></p><!-- get meetodil -->
	<p><a href="photoupload.php">Fotode üleslaadimine</a></p>
	<img src="<?php echo $picDir .$picFile; ?>" alt="foto">     
	
</body>
</html>