<?php
require("functions.php");
//require("usersinfotable.php");

//Kui pole sisselogitud, saadab login lehele
if(!isset($_SESSION["userId"])){
	header("Location: login.php");
	exit();
}

//Väljalogimine
if(!isset($_GET["logout"])){
	session_destroy(); //lõpetab sessioni
	header("Location: login.php");
}

?>

</head>
<body class="bg-dark">
    <div class="row">
	<div class="col-sm-2">
		<p><a href="?logout=1">Logi välja</a></p>
		<p><a href="main.php">Pealeht</a></p>
	</div>

<p>Õnnestus</p>