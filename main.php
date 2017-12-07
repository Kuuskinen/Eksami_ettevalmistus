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
	$picDir = "pics/";
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
	
	echo "Kasutaja: ".$_SESSION["userId"];
	
?>	


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kosmosefotod?</title>
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
	<center><img src="<?php echo $picDir .$picFile; ?>" alt="foto"></center> 
</body>

<body style="background-color:lightgrey;">
    <center><h1>NASA kosmosefotod</h1>
	<h4>Sa oled sisselogitud kui: <?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?></h4> 
	<p>PEALEHT</p>
	</center>

</body>
</html>