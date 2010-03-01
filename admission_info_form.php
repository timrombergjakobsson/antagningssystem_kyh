<?php
	include ('db_connect.php');
	include ('get_educations.php');
	include ('handle_mysql_query.php');
	
	$conn1 = db_connect();
	$educations = get_educations($conn1);

	function display_educations ($educations) {	
		
		foreach ($educations as $education) {
		
			$checkboxes = $checkboxes . 	'<div class="checkbox"><input type="checkbox" id="education" name="education" value="' . $education['id'] . '" />' .
											$education['name'] . ', ' . $education['city'] . '</div>';

		}

		return $checkboxes;
		
	}
	
?>

<<??>?xml version="1.0" encoding="UTF-8"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
		"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Intag</title>
		<link href="style.css" media="screen" type="text/css" rel="stylesheet"/>

	</head>

	<body>
	
		<div id="Intagsinformation">

			<form action="" method="post">

				<fieldset>
					<legend>Nytt intag</legend>
					
					<label for="semester">Termin</label>
					<select name="semester" id="semester">
						<option>Ht</option>
						<option>Vt</option>	
					</select>

					<label for="year">&Aring;r</label>
					<select name="year" id="year">
						<option>2009</option>
						<option>2010</option>
						<option>2011</option>
						<option>2012</option>
						</select>

					<label for="last_application_date">Sista ans&ouml;kningsdatum</label>
					<input type ="text" id="last_application_date" name="last_application_date" />
					
					<label for="last_completion_date">Sista kompletteringsdatum</label>
					<input type ="text" id="last_completion_date" name="last_completion_date" />
					
					<fieldset>
						<legend>Utbildningar</legend>
						<?php echo display_educations($educations); ?>
					</fieldset>	

					<input type="submit" name="submit_admission" value="spara" />
					


				</fieldset>	
			</form>
		</div>
	</body>
</html>