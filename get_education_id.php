<?php
/* Hämtar ut det id som tillhör en viss utbildning, genom att leta upp utbildningnamn och stad
 * från education tabellen*/ 
function get_education_id($name, $city) {
		$query = "SELECT id 
					FROM education 
					WHERE name =  '$name'
					AND city =  '$city'";
		
		$answer = handle_mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}