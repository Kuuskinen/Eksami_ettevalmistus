<?php
	require("functions.php"); //seal on näiteks sessiooni muutujad
	require("editideafunctions.php");
	$notice = "";                                                                                                                    //SEE ON ÕIGE
	
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
	
	if(isset($_POST["ideaButton"])){
	    updateIdea($_POST["idea"], test_input($_POST["ideaColor"]), $_POST["id"]);
        //jään siiasamasse
        header("Location: ?id=" .$_POST["id"]);
        exit();	   
	}
	
	if(isset($_GET["delete"])){
		deleteIdea($_GET["id"]);
		header("Location: usersideas.php");
		exit();
	}
		//2mb on piltidel maksimum
	$idea = getSingleIdea($_GET["id"]); //see loeb midagi. idea ütleb, et ühe mõtte
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tsitaadi muutmine</title>
</head>
<body>
	<h1>Tsitaadi muutmine</h1>
	<p>See leht on loodud tõsise õppetöö raames ning sisaldab ainult tõsiseltvõetavat sisu.</p>
	<<meta name="viewport" content="width=device-width, initial-scale=1">
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
      <li class="active"><a href="main.php">Pealeht</a></li>
      <li><a href="foto.php">Pildid</a></li>
	  <li><a href="usersInfo.php">Kasutajate andmed</a></li>
	  <li><a href="userphotos.php">Tsitaadid</a></li>
	  <li><a href="?logout=1">Logi välja</a></li>
    </ul>
  </div>
</nav>
	<hr>
	<h2>Toimeta mõtet</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	    <input name="id" type="hidden" value="<?php echo $_GET["id"]; ?>"><!--POSTiga läheb kaasa aga ei näidata-->
		<label>Hea mõte: </label>
		<textarea name="idea"><?php echo $idea->text;?></textarea> <!-- textarea korral igal juhul tekst-->
		<br>
		<label>Mõttega seonduv värv: </label>
		<input name="ideaColor" type="color" value="<?php echo $idea->color; ?>"> <!-- me tahame varem valitud värvi-->
		<br>
		<input name="ideaButton" type="submit" value="Salvesta muudetud mõte!">
		<span><?php echo $notice; ?></span>
		
	</form>
	<p><a href="?id=<?php echo $_GET['id']; ?>&delete=1">Kustuta</a> see mõte.</p> 
	<!-- <a href="?id=19&delete=1"> -->
	<hr>
	
</body>
</html>