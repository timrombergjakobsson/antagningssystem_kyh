<?php

// funktion som sparar application. Vi förutsätter att utbildningens namn och stad finns, samt personnummer, status, grundläggande behörighet och prioritet.
// 
function save_application($application_input, $basic_eligibility, $application_occasion_id, $conn) {

	// Översätter de olika svenska alternativen 'Ja','Nej','Dispens' till 'yes','no','exemption'
	if ($basic_eligibility == "Ja") {
		$basic = "yes";
	} elseif ($basic_eligibility == "Nej") {
		$basic = "no";
	} elseif ($basic_eligibility == "Dispens") {
		$basic = "exemption";
	}
	
	$query = "INSERT INTO application (status, basic_eligibility, priority, application_occasion_id, education_start_id)
			VALUES (
				'in progress',
				'$basic',
				'{$application_input['priority']}',
				$application_occasion_id,
				'{$application_input['id']}'
			)";
			
	return handle_mysql_query($query,$conn);			
}