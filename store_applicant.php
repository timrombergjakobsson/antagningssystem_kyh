<?php

function store_applicant($input) {
	
	$query = "INSERT INTO applicant
			 		`personal_number` = '{$input['personal_number']}',
					`surname` = '{$input['surname']}', 
					`firstname` = '{$input['firstname']}', 
					`co_address` = '{$input['co_address']}', 
					`address` = '{$input['address']}', 
					`postal_code` = '{$input['postal_code']}',
					`postal_area` = '{$input['postal_area']}', 
					`telephone` =  '{$input['telephone']}', 
					`mobile` = '{$input['mobile']}', 
					`e_mail` = '{$input['e_mail']}'";
    
	$answer = mysql_query($query);
    return $answer;
}

