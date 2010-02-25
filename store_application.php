<?php
/* Funktionens syfte �r att lagra en intresseanm�lan till ett intag. 
 * $input skall vara en array med nycklarna 'personal_number', 'admission_id', 'arrival_date', 'basic_eligibility',
 * 'priority', 'personal_number', 'education_start_id', 'education_id', 'admission_id'.
 * Funktionen returnerar en boolean d�r true inneb�r att intresseanm�lan gick att lagra.
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
	
	/* Ist�llet f�r att tvinga anv�ndaren skriva in education_start_id, l�ter vi funktionen ta reda p� den �t oss.  */
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