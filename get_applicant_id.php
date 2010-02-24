 <?php
 function get_applicant_id($personal_number) {
		$query = "SELECT id 
				FROM applicant
				WHERE personal_number = '$personal_number'";
		
		$answer = mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}