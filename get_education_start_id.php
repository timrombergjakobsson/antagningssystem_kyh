 <?php
 /* Hämtar ut det id som tillhör en viss utbildningsstart, genom att jämföra med främmande-nycklarna till 
  * education och admission  och det som finns i education_start tabellen. 
  * education_id är id:et som anger vilken utbildning det är.
  * admission_id är id:et som anger vilket intag det är.
  * Funktionen returnerar utbildningsstart id:et ifall det finns en utbildningsstart med det intaget och utbildningen,
  * annars NULL. 
 */
 function get_applicant_id($education_id,$admission_id) {
		$query = "SELECT id 
				FROM education_start
				WHERE education_id = $education_id
				AND admission_id = $admission_id";
		
		$answer = mysql_query($query, db_connect());
		$row = mysql_fetch_array($answer);
		$id = $row['id'];
		return $id;
	}