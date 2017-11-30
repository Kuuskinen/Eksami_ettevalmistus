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
	/*kui soovitakse ideed salvestada
	if(isset($_POST["ideaBtn"])){
		//echo $_POST["ideaColor"];
		if(isset($_POST["userIdea"]) and isset($_POST["ideaColor"]) and !empty($_POST["userIdea"]) and !empty($_POST["ideaColor"])){
			$myIdea = test_input($_POST["userIdea"]);
			$notice = saveMyIdea($myIdea, $_POST["ideaColor"]);
		}
	}*/
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>NASA kosmosefotod</title>
</head>
<body>
	<h1>NASA kosmosefotod</h1>
	<p>Ma püüan sellest midagi aretada ;)</p>
	<p><a href="?logout=1">Logi välja!</a></p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Sinu laetud fotod ja tsitaadid</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Lisa uus tsitaat</label>
		<input name="userIdea" type="text">
		<br>
	
		<input name="ideaBtn" type="submit" value="Salvesta"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Sisestatud tsitaadid</h2>
	<div style="width: 40%">
		<?php echo listIdeas(); ?>
	</div>
	
	
</body>
</html>

