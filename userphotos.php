<?php
	require("functions.php");
	$notice="";
	
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
	//kui soovitakse ideed salvestada
	if(isset($_POST["ideaButton"])){
		//echo $_POST["ideaColor"];
		if(isset($_POST["userIdea"]) and isset($_POST["ideaColor"]) and !empty($_POST["userIdea"]) and !empty($_POST["ideaColor"])){
			$myIdea = test_input($_POST["userIdea"]);
			$notice = saveIdea($myIdea, $_POST["ideaColor"]);
			echo $notice;
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>NASA kosmosefotod</title>
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
      <li class="active"><a href="main.php">Pealeht</a></li>
      <li><a href="foto.php">Pildid</a></li>
	  <li><a href="userphotos.php">Tsitaadid</a></li>
	  <li><a href="usersInfo.php">Kasutajate andmed</a></li>
	  <li><a href="?logout=1">Logi välja</a></li>
    </ul>
  </div>
</nav>
	<h1>NASA kosmosefotod</h1>
	<p>Siin näed oma üleslaetud tsitaate, saad neid muuta ja näed kõiki üleslaetud pilte.</p>
	<hr>
	<h2>Tsitaadid</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Lisa uus tsitaat</label>
		<input name="userIdea" type="text">
		<br>
		<label>Mõttega seonduv värv: </label>
		<input name="ideaColor" type="color">
		<br>
		<input name="ideaButton" type="submit" value="Salvesta mõte!">
		<span><?php echo $notice; ?></span>
		
	</form>
	<hr>
	<div style="width: 40%">
		<?php echo listIdeas(); ?>
	</div>
</body>
</html>

