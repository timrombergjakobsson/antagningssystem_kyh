<?php
// skall returnera allt ifrån education tabellen som hör ihop med ett visst intag.
function get_education_starts($admission_id,$conn){
	
		$query = 	"SELECT `education`.id, name, city
					FROM education_start, education
					WHERE `education`.id = education_id
					AND admission_id = $admission_id";
					
		$answer = handle_mysql_query($query, $conn);
		$result;
		$i = 0;
		while ($row = mysql_fetch_assoc($answer)) {
			$result[$i] = $row;
			$i++;
		}
		return $result;
}



?>