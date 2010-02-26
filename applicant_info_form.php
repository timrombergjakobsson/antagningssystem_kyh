<<??>?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Användarinfo</title>
	<link href="style.css" media="screen" type="text/css" rel="stylesheet"/>
	
</head>

<body>
	
	<h1></h1>
	<div id="Personinformation">
	<?php

		function db_connect(){
	
			$dbhost = "localhost";
			$dbuser = "reldb4";
			$dbpass = "dbPass04";
			$dbname = "ad09_reldb4";

			$conn = mysql_connect($dbhost, $dbuser, $dbpass);
			$db_selected = mysql_select_db ($dbname, $conn);
			if (!$conn || !$db_selected) {
	    		die('Could not connect: ' . mysql_error());
				
			}else{
				echo 'Connected successfully';
				
			}
			return $conn;
		}
				/* Sätter in data i databasen om någon har fyllt i formuläret. */
		function store_applicant($input) {
	
			$query = "INSERT INTO applicant
			 SET `personal_number` = '{$input["personal_number"]}',
				`surname` = '{$input["surname"]}', 
				`firstname` = '{$input["firstname"]}', 
				`co_address` = '{$input["co_address"]}', 
				`address` = '{$input["address"]}', 
				`postal_code` = '{$input["postal_code"]}',
				`postal_area` = '{$input["postal_area"]}', 
				`telephone` =  '{$input["telephone"]}', 
				`mobile` = '{$input["mobile"]}', 
				`e_mail` = '{$input["e_mail"]}'";
    
			$answer = mysql_query($query, db_connect());
    		return $answer;
		}

		if (isset($_POST['posted'])) {
			$input = $_POST;
			$store_personal_info_result = store_applicant($input);
		}

		/* En associativ array för att spara hur databaskolumnen, texten, och id:et för css:en hör ihop för varje inmatningsfält */
		$personal_list = Array(
						Array('db_column' => "personal_number",		'id' => "personal_number",	'text' => "Personnummer"),
						Array('db_column' => "surname", 			'id' => "surname",			'text' => "Efternamn"),	
						Array('db_column' => "firstname", 			'id' => "firstname",		'text' => "Förnamn"),	
						Array('db_column' => "co_address", 		'id' => "co_address",		'text' => "c/o Adress"),
						Array('db_column' => "address", 			'id' => "address",			'text' => "Adress"),
						Array('db_column' => "postal_code", 		'id' => "postal_code",		'text' => "Postnummer"),
						Array('db_column' => "postal_area", 		'id' => "postal_area",		'text' => "Postort"),
						Array('db_column' => "telephone", 		'id' => "telephone",		'text' => "Telefon"),
						Array('db_column' => "mobile",	'id' => "mobile",			'text' => "Mobiltelefon"),
						Array('db_column' => "e_mail", 				'id' => "e_mail",			'text' => "E-mail")
						);
		
		/* Formuläret. */
		echo "<form action='' method='post'>\n";
		echo "\t<fieldset>\n";
		echo "\t<legend>Personinformation</legend>\n";
		/* Ett gömt fält som säger när en användare har  skickat data. */
		echo "\t\t<input type='hidden' id='posted' name='posted' value='true'>\n";
			
			/* Går igenom varje rad och skriver ut motsvarande label/input taggar. Alltså 1. Personnummer, 2. Efternamn, ... */
		foreach($personal_list as $row){
			/* Label - Input taggar (med försök till rätt indentering i den genererade html-filen). */
			echo "\t\t<label for='{$row['id']}'>{$row['text']}</label>\n";
			echo "\t\t<input type='text' id='{$row['id']}' name='{$row['db_column']}' />";
		}
		/* Submitknapp. */
		echo "\t\t<label for='submit'></label>";
		echo "\t\t<input type='submit' id='submit' name='submit_applicant' value='Skicka' />";
		
		echo "\t</fieldset>";	
		echo "</form>";

	?>
	</div>
</body>
</html>
