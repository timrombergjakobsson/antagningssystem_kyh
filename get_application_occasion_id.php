<?php

	/* Funktion som hämtar ut application_occasion_id. Vill ha personnummer och admission-id och returnerar idt.
	*/

	function get_application_occasion_id($personal_number, $admission_id) {
		$query = "SELECT id 
				FROM application_occasion
				WHERE applicant_personal_number = '$personal_number'
				AND admission_id = $admission_id";		
		
		$result = handle_mysql_query($query);
		$row = mysql_fetch_array($result);
		$id = $row['id'];
		return $id;
	}


?>