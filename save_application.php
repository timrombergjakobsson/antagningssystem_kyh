<?php

// funktion som sparar application. Vi förutsätter att utbildningens namn och stad finns, samt personnummer, status, grundläggande behörighet och prioritet.
// 
function save_application($application_input,$conn) {

	// Hämtar de främmandenycklar som ansökan beror på.
	$education_id = get_education_id($application_input['name'], $application_input['city']);
	$admission_id = get_admission_id($conn);
	
	// Översätter de olika svenska alternativen 'Ja','Nej','Dispens' till 'yes','no','exemption'
	if ($application_input['basic_eligibility'] == "Ja") {
		$application_input['basic_eligibility'] = "yes";
	} elseif ($application_input['basic_eligibility'] == "Nej") {
		$application_input['basic_eligibility'] = "no";
	} elseif ($application_input['basic_eligibility'] == "Dispens") {
		$application_input['basic_eligibility'] = "exemption";
	} else {
		$application_input['basic_eligibility'] = "";
	}	
	
	$application_occasion_id = get_application_occasion_id($application_input['personal_number'], $admission_id);
	$education_start_id = get_education_start_id($education_id, $admission_id);

	$query = "INSERT INTO application (status, basic_eligibility, priority, application_occasion_id, education_start_id)
			VALUES (
				'in progress',
				'{$application_input['basic_eligibility']}',
				'{$application_input['priority']}',
				$application_occasion_id,
				$education_start_id
			)";
			
	return handle_mysql_query($query,$conn);			
}