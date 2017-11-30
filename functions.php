<?php
	$database = "if17_lutsmeel"; //<---- KASUTAME MEELISE ANDMEBAASI
	require("../../config.php");
	//alustame sessiooni
	session_start();
	
	//sisselogimise funktsioon
	function signIn($email, $password){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT firstname, lastname, id, email, password FROM vpusers WHERE email = ?");   
		$stmt->bind_param("s",$email);
		$stmt->bind_result($firstname, $lastname, $id, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime kasutajat
		if($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik korras! Logisimegi sisse!";
				
				//salvestame sessioonimuutujaid
				$_SESSION["firstname"] = $firstname;
				$_SESSION["lastname"] = $lastname;
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//liigume pealehele
				header("Location: main.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei ole!";
		}
		return $notice;
	}
	
	//uue kasutaja andmebaasi lisamine
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
		//loome andmebaasiühenduse
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	function saveIdea($idea, $color){																		//püüame userideast kinni need
		$notice="";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare ("INSERT INTO userideas(userid, idea, ideacolor)VALUES(?, ?, ?) ");
		//echo $ mysqli->error;
		$stmt->bind_param("iss", $_SESSION["userId"], $idea, $color);              //mida tabelisse
		if($stmt->execute()){
			$notice = "Mõte salvestatud";
		}else{
			$notice = "salvestamisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
		return$notice;
		
	}
	
	function listIdeas(){ 
		$notice="";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//$stmt= $mysqli->prepare ("SELECT idea, ideacolor, FROM userideas");
		//$stmt= $mysqli->prepare ("SELECT idea, ideacolor, FROM userideas ORDER by id DESC");
		$stmt= $mysqli->prepare ("SELECT id, idea, ideacolor FROM userideas WHERE userid =? AND deleted IS NULL ORDER by id DESC ");
		echo$mysqli->error;
		$stmt->bind_param("i", $_SESSION["userId"]);
		$stmt->bind_result($id, $idea, $color); // järjekord peab sama olema mis rida 81
		$stmt->execute();
		
		while($stmt->fetch()){
			//<p style="background-color: #ff5577"> hea mõte </p>
			//$notice .= '<p style="background-color:' .$color .'">' .$idea ."</p> /n";
			$notice .= '<p style="background-color:' .$color .'">' .$idea .' | <a href="edituserideas.php?id=' .$id .'">Toimeta</a>' ."</p> \n";
			//<p style="background-color: #ff5577"> Kõike saab paremini </p>
			//<p style="background-color: #ff5577"> Kõike saab paremini | <a href="edituseridea.php?id=34">Toimeta </a></p>                             //|| vajalik osades keeltes viisakusest siin alt gr <> korra
		}
		
		
		$stmt->close();
		$mysqli->close();
		return$notice;
	}
	function latestIdea(){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT idea FROM userideas WHERE id= (SELECT MAX(id) FROM userideas WHERE deleted IS NULL)");
		echo $mysqli ->error;
		$stmt->bind_result($idea);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		$mysqli->close();
		return$idea;
	}
		
	//sisestuse kontrollimine
	function test_input($data){
		$data = trim($data);//eemaldab lõpust tühiku, tab vms
		$data = stripslashes($data);//eemaldab "\"
		$data = htmlspecialchars($data);//eemaldab keelatud märgid
		return $data;
	}
	
?>