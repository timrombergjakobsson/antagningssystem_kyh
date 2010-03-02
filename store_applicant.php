<?php
	/* */
	function store_applicant($input,$conn) {
		/* */
		$query = "	INSERT INTO applicant (	
						`personal_number`,
						`surname` , 
						`firstname` ,
						`co_address` ,
						`address` , 
						`postal_code` ,
						`postal_area` ,
						`telephone` , 
						`mobile` , 
						`e_mail`
					) 
					VALUES (
						'{$input["personal_number"]}',
						'{$input["surname"]}', 
						'{$input["firstname"]}', 
						'{$input["co_address"]}', 
						'{$input["address"]}', 
						'{$input["postal_code"]}',
						'{$input["postal_area"]}', 
						'{$input["telephone"]}', 
						'{$input["mobile"]}', 
						'{$input["e_mail"]}'
					)
					ON DUPLICATE KEY UPDATE
						`surname` 		= '{$input["surname"]}', 
						`firstname` 	= '{$input["firstname"]}', 
						`co_address` 	= '{$input["co_address"]}', 
						`address` 		= '{$input["address"]}', 
						`postal_code` 	= '{$input["postal_code"]}',
						`postal_area` 	= '{$input["postal_area"]}', 
						`telephone` 	= '{$input["telephone"]}', 
						`mobile` 		= '{$input["mobile"]}', 
						`e_mail` 		= '{$input["e_mail"]}'
					";
		
		$answer = handle_mysql_query($query,$conn);
		return $answer;
	}