<?php
function store_application($input) {

	$query1 = "INSERT INTO admission_occasion (
				applicant_personal_number,
				admission_id,
				arrival_date,
				registration_date
				)
			VALUES (
				{$input['personal_number']}, 
				{$input['admission']},
				{$input['arrival_date']},
				CURDATE()
			)";
	
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
				{$input['admission_occasion_id']},
				{$input['admission_occasion_applicant_personal_number']},
				{$input['education_start_id']},
				{$input['education_start_education_id']},
				{$input['education_start_admission_id']},
			)";
	
	$answer = mysql_query($query1, db_connect());
	if ($answer)
		$answer = mysql_query($query2, db_connect());
    return $answer;
}