<?php

function store_applicant($input,$conn) {
	
	$query = "INSERT INTO applicant
			 SET `personal_number` = '{$input["personal_number"]}',
				`surname` = '{$input["surname"]}', 
				`firstname` = '{$input["firstname"]}', 
				`co_address` = '{$input["co_address"]}', 
				`address` = '{$input["address"]}', 
				`postal_code` = '{$input["postal_code"]}',
				`postal_area` = '{$input["postal_area"]}', 
				`telephone` =  '{$input["telephone"]}', 
				`mobile` = '{$input["mobile"]}', 
				`e_mail` = '{$input["e_mail"]}'";
    
	$answer = handle_mysql_query($query,$conn);
    return $answer;
}

