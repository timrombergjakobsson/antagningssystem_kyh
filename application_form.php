<<??>?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>Ans&ouml;kan</title>
	<link href="style.css" media="screen" type="text/css" rel="stylesheet"/>
	
</head>

<body>
	
	<h1></h1>
	<div id="Ans&ouml;kaninformation">
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
	?>
	<form action="" method="post">
		
		<fieldset>
		<legend>Ansökan</legend>

			<label for="arrival_date">Ansökan ankom</label>
			<input type ="text" id="arrival_date" name="arrival_dates" />
			
			<label for="education_1">Utbildning 1:a prio</label>
			<select name="education_1" id="education_1">
				<option>Agile Developer, Stockholm</option>
				<option>Agile Developer, Göteborg</option>
				<option>Energy Consultant, Stockholm</option>
				<option>Energy Consultant, Malmö</option>
				<option>IT Management, Stockholm</option>
				
			</select>
			
			<label for="education_2">Utbildning 2:a prio</label>
			<select name="education_2" id="education_2">
				<option>Ingen</option>
				<option>Agile Developer, Stockholm</option>
				<option>Agile Developer, Göteborg</option>
				<option>Energy Consultant, Stockholm</option>
				<option>Energy Consultant, Malmö</option>
				<option>IT Management, Stockholm</option>

			</select>
			
			<label for="education_3">Utbildning 3:e prio</label>
			<select name="education_3" id="education_3">
				<option>Ingen</option>
				<option>Agile Developer, Stockholm</option>
				<option>Agile Developer, Göteborg</option>
				<option>Energy Consultant, Stockholm</option>
				<option>Energy Consultant, Malmö</option>
				<option>IT Management, Stockholm</option>

			</select>

			<label for="basic_eligibility">Grundläggande behörighet</label>
			<select name="basic_eligibility" id="basic_eligibility">
				<option>Ja</option>
				<option>Nej</option>
				<option>Dispens</option>
			</select>
			
			<input type="submit" name="submit" value="spara" />

	
	</fieldset>	
	</form>
	</div>
</body>
</html>
