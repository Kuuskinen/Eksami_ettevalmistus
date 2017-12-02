<?php
	//kui pole sisseloginud, siis sisselogimise lehele
	/*if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}*/
	
	function createUsersTable(){
		$table = '<table border="1" style="border: 1px solid black; border-collapse: collapse">' ."\n"; //Alustab HTML tabeli ja määrab piirjooned. See hall annab inimesele märku, et see on HTML tabel.
		$table .= "<tr> \n <th>eesnimi</th><th>perekonnanimi</th><th>e-posti aadress</th><th>sünnipäev</th><th>sugu</th> \n </tr> \n"; // HTML tabeli päis
		
		//loen andmed
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT firstname, lastname, email, birthday, gender FROM vpusers");
		$stmt->bind_result($firstname, $lastname, $email, $birthday, $gender); //baasi vastus
		$stmt->execute();
		//tsükkel, mis läbib kõik tabeli read
		while($stmt->fetch()){
			if($gender == 1){
				$gender = "mees";
			} else {
				$gender = "naine";
			}
			$table .= "<tr> \n <td>" .$firstname ."</td><td>" .$lastname ."</td><td>" .$email ."</td><td>" .$birthday ."</td><td>" .$gender ."</td> \n </tr>"; //Paigutab väärtused tabelisse
		}
		
		$table .= "</table> \n"; //lõpetab tabeli
		$stmt->close();
		$mysqli->close();
		return $table; //tagastab usersInfo-le tabeli
	}
	
?>