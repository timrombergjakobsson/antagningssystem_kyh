<?php

	//funktion som hämtar admission_id. Returnerar ett id om sökt admission finns, eller felmeddelande om det inte finns.
	function get_admission_id($input,$conn) {
		// Default är 'HT'
		if ($input['semester'] == 'VT') {
			$semester = 'VT';
		} else {
			$semester = 'HT';
		}
		
		$query = 	"SELECT	id
					FROM	admission
					WHERE	semester = '$semester'";
		
		// Bygger på frågan med ett villkor på året. 
		// Separat fall då vi vill använda default-värdet som är det här året.
		if ($input['year'] <= 2000) {
			$query = $query . "
					AND		year = YEAR(CURDATE())"; // Default
		} else {
			$query = $query . "
					AND		year = '{$input['year']}'";
		}
		
		$result = handle_mysql_query($query, $conn);
		$answer = mysql_fetch_assoc($result);
		
		if (!$answer) {
			return "No admission found" . $query;
		} else {
			return $answer['id'];
		}
		
	}

?>