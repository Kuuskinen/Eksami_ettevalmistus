<?php
require("functions.php");
require("usersInfotable.php");

//Kui pole sisselogitud, saadab login lehele
if(!isset($_SESSION["userId"])){
	header("Location: login.php");
	exit();
}

//Väljalogimine
if(isset($_GET["logout"])){
	session_destroy(); //lõpetab sessioni
	header("Location: login.php");
}
//PHP käib kogu koodi läbi ja teeb oma asju(nt. prindib HTMLi juurde/muudatusi. Pärast käimist on PHP kood nö kadunud ja alles on ainult HTML ja siis see HTML saadetakse brauserisse, millega ta näitab ilusat pilti.
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
<body>
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
<h1>Kõik kasutajad</h1>
<?php echo createUsersTable(); ?>