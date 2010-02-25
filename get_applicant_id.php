 <?php
 /* Hämtar ut det id som tillhör en viss ansökande, genom leta upp den ansökande på personnumret i databasen.
  * personal_number är den ansökandes personnummer. Den är unik, så den går att använda för att få tag på id:et.
  * Funktionen returnerar id:et ifall det finns en ansökande med det angivna personnumret, annars NULL. 
 */
 function get_applicant_id($personal_number) {
		$query = "SELECT id 
				FROM applicant
				WHERE personal_number = '$personal_number'";
		
		$answer = mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}