<?php
	/* funktion som lägger in personinformation på sökande och ävern kollar om sökande finns. 
	INSERT INTO lägger in informationen på sökande i databasen. ON DUPLICATE KEY kollar om
	personnummer redan finns.  Om det finns så hämtar den ut all information utom personnummer 
	för eventuell editering. */
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
					//Kollar om personnummer redan finns och ger en möjlighet att editera övrig info.
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
		//returnerar funktionen som hanterar mysql_query felmeddelanden.
		$answer = handle_mysql_query($query,$conn); 
		return $answer;
	}