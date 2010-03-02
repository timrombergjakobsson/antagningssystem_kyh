<<??>?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Användarinfo</title>
	<link href="./css/style.css" media="screen" type="text/css" rel="stylesheet"/>
	
</head>

<body>
	
	<h1></h1>
	<div id="Personinformation">
	<?php
		/* Sätter in data i databasen om någon har fyllt i formuläret. */
		$conn = db_connect();
		
		/* Testar genom att skriva in personnummer direkt i här. */
		$personal_number = $_POST['personal_number'];
		$admission_id = $_POST['admission_id'];
		
		if (isset($personal_number)) {
			/* Fulhack!!! Bör vara en egen funktion. */
			$answer = handle_mysql_query("SELECT * FROM `applicant` WHERE personal_number = '$personal_number'", $conn);
			$personal_data = mysql_fetch_assoc($answer); // Högst ett resultat.
		}
		
		if (isset($_POST['posted'])) {
			$personal_data = $_POST;
			$personal_data['personal_number'] = $personal_number;
			$store_personal_info_result = store_applicant($personal_data,$conn);
		}

		/* En associativ array för att spara hur databaskolumnen, texten, och id:et för css:en hör ihop för varje inmatningsfält */
		$personal_list = Array(
						Array('db_column' => "surname", 		'id' => "surname",			'text' => "Efternamn"),	
						Array('db_column' => "firstname", 		'id' => "firstname",		'text' => "F&ouml;rnamn"),	
						Array('db_column' => "co_address", 		'id' => "co_address",		'text' => "c/o Adress"),
						Array('db_column' => "address", 		'id' => "address",			'text' => "Adress"),
						Array('db_column' => "postal_code", 	'id' => "postal_code",		'text' => "Postnummer"),
						Array('db_column' => "postal_area", 	'id' => "postal_area",		'text' => "Postort"),
						Array('db_column' => "telephone", 		'id' => "telephone",		'text' => "Telefon"),
						Array('db_column' => "mobile",			'id' => "mobile",			'text' => "Mobiltelefon"),
						Array('db_column' => "e_mail", 			'id' => "e_mail",			'text' => "E-mail")
						);
		
		/* Formuläret. */
		echo "<form action='' method='post'>\n";
		echo "\t<fieldset>\n";
		echo "\t<legend>Personinformation f&ouml;r $personal_number</legend>\n";
		/* Ett gömt fält som säger när en användare har  skickat data. */
		echo "\t\t<input type='hidden' id='personal_number' name='personal_number' value='$personal_number'>\n";
			echo "\t\t<input type='hidden' id='admission_id' name='admission_id' value='$admission_id'>\n";
		echo "\t\t<input type='hidden' id='posted' name='posted' value='true'>\n";
			
			/* 	Går igenom varje rad och skriver ut motsvarande label/input taggar. Alltså 
				1. Personnummer, 2. Efternamn, ... 
				...
				<label for='personal_number'>Personnummer</label>
				<input type='text' id='personal_number' name='personal_number' value='{$personal_data['personal_number']}' />
				...
			*/
		foreach($personal_list as $row){
			/* Label - Input taggar (med försök till rätt indentering i den genererade html-filen). */
			echo "\t\t<label for='{$row['id']}'>{$row['text']}</label>\n";
			echo "\t\t<input class='focus' type='text' id='{$row['id']}' name='{$row['db_column']}' value='{$personal_data[$row['db_column']]}' />";
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
