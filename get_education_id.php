<?php
/* H�mtar ut det id som tillh�r en viss utbildning, genom att leta upp utbildningnamn och stad
 * fr�n education tabellen*/ 
function get_education_id($name, $city, $conn) {
		$query = "SELECT id 
					FROM education 
					WHERE name =  '$name'
					AND city =  '$city'";

		$answer = mysql_query($query, $conn);
		$row = mysql_fetch_assoc($answer);
		$id = $row['id'];
		return $id;
	}