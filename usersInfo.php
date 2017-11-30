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

?>

<table border="15">
	<tr>
	<th><p><a href="?logout=1">Logi välja</a></p>	
	<p><a href="main.php">Pealeht</a></p>
	<p><a href="photoupload.php">Fotode üleslaadimine</a></p>
	</th>
	</tr>
</table>

<!DOCTYPE html>
<body>
<h1>Kõik kasutajad</h1>
<?php echo createUsersTable(); ?>