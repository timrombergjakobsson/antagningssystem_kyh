<?php

	//funktion som hämtar admission_id. Returnerar ett id om sökt admission finns, eller felmeddelande om det 					inte finns.
	function get_admission_id($conn) {
		
		$query = 	"SELECT id
					FROM admission
					WHERE semester_start = '2010-08-23'";
					
		$result = handle_mysql_query($query, $conn);
		$answer = mysql_fetch_assoc($result);
		
		if (!$answer) {
			return "No admission found";
		} else {
			return $answer['id'];
		}
		
	}

?>