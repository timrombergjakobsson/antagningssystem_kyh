<?php


	//Hämtar ut namn och stad för alla útbildningar. Syfter är att skriva ut dem i ansökningsformuläret.
	function get_educations($conn) {
		
		$query = 	"SELECT *
					FROM education";
					
		$answer = handle_mysql_query($query, $conn);
		$result;
		$i = 0;
		while ($row = mysql_fetch_assoc($answer)) {
		
			$result[$i] = $row;
			$i++;
			
		}
		return $result;
	}