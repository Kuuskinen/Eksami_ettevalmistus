
<?php
	// Hello, It´s a test muutujad.
	//$myName = "Karl";
	//$myFamilyName = "Raid";
	$picDir = "pics/";
	$picFiles = [];
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
	
	$allFiles = array_slice (scandir($picDir), 2);
	foreach ($allFiles as $file){
		$fileType = pathinfo ($file,  PATHINFO_EXTENSION);
		if (in_array($fileType, $picFileTypes) ==true){
			array_push($picFiles, $file);           // kui soonelised suled lõppevadsiis ; 
		}
	}
	//Var_dump($allFiles);
	//$picFiles = array_slice($allFiles, 2);
	//var_dump($picFiles);
	$picFileCount = count ($picFiles);
	$picNumber = mt_rand(0, $picFileCount - 1);    
	$picFile = $picFiles[$picNumber];
	
	

?>	

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Photos</title>
	<meta charset="utf-8">
	<title>Vahi pilte</title>
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
      <li><a href="photoupload.php">Pildi üleslaadimine</a></li>
	  <li><a href="usersInfo.php">Kasutajate andmed</a></li>
	  <li><a href="?logout=1">Logi välja</a></li>
    </ul>
  </div>
</nav>
<img src="<?php echo $picDir .$picFile;?>" alt="Pilt">