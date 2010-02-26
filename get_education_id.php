<?php
/* Hämtar ut det id som tillhör en viss utbildning, genom att leta upp utbildningnamn och stad
 * från education tabellen*/ 
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