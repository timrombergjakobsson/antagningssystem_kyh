<?php
	function get_education($name, $city) {
		$query = "SELECT id 
					FROM education 
					WHERE name = $name 
					AND city = $city";
	
		$answer = handle_mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}