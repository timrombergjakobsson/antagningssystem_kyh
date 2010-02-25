<?php
/* Funktionens syfte är att lagra en intresseanmälan till ett intag. 
 * $input skall vara en array med nycklarna 'personal_number', 'admission_id', 'arrival_date', 'basic_eligibility',
 * 'priority', 'personal_number', 'education_start_id', 'education_id', 'admission_id'.
 * Funktionen returnerar en boolean där true innebär att intresseanmälan gick att lagra.
*/
function store_application($input) {

	$query1 = "INSERT INTO admission_occasion (
				id,
				applicant_personal_number,
				admission_id,
				arrival_date,
				registration_date
				)
			VALUES (
				NULL,
				{$input['personal_number']}, 
				{$input['admission_id']},
				{$input['arrival_date']},
				CURDATE()
			)";
	
	/* Istället för att tvinga användaren skriva in education_start_id, låter vi funktionen ta reda på den åt oss.  */
	$input['education_start_id'] = get_education_start_id($input['admission_id']);
	
	$query2 = "INSERT INTO application (
				status,
				basic_eligibility,
				priority,
				admission_occasion_id,
				admission_occasion_applicant_personal_number,
				education_start_id,
				education_start_education_id,
				education_start_admission_id
				)
			VALUES (
				'under process',
				{$input['basic_eligibility']},
				{$input['priority']},
				{LAST_INSERT_ID()},
				{$input['personal_number']},
				{$input['education_start_id']},
				{$input['education_id']},
				{$input['admission_id']},
			)";

	
	$answer = handle_mysql_query($query1, db_connect());
	if ($answer)
		$answer = handle_mysql_query($query2, db_connect());
    return $answer;
}