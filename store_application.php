<?php
function store_application($input) {

	$query = "INSERT INTO admission_occasion (
				personal_number,
				admission_id,
				arrival_date,
				registration_date,
				)
			VALUES (
				{$input['personal_number']}, 
				{$input['admission']},
				{$input['arrival_date']},
				CURDATE()
			)";
	
	$answer = mysql_query($query, db_connect());
    return $answer;
}