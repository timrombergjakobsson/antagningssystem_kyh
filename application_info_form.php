<?php


	$conn1 = db_connect();
	$educations = get_educations($conn1);
	$personal_number = $_POST['personal_number'];
	$admission_id = $_POST['admission_id'];

	function display_educations ($educations) {

		foreach ($educations as $education) {
		
			$options = $options . "<option>{$education['name']}" . ", " . "{$education['city']}</option>";
		
		}
	
		return $options;
		
	}
	
	
?>
<<??>?xml version="1.0" encoding="UTF-8"?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
		"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Ans&ouml;kan</title>
		<link href="style.css" media="screen" type="text/css" rel="stylesheet"/>

	</head>

	<body>

		<h1></h1>
		<div id="Ans&ouml;kaninformation">

			<form action="" method="post">

				<fieldset>
					<legend>Ans&ouml;kan för <?php echo $personal_number; ?></legend>

					<label for="arrival_date">Ans&ouml;kan ankom</label>
					<input type ="text" id="arrival_date" name="arrival_date" />
				
					<label for="education_1">Utbildning 1:a prio</label>
					<select name="education_1" id="education_1">
						<?php echo display_educations($educations); ?>
					</select>

					<label for="education_2">Utbildning 2:a prio</label>
					<select name="education_2" id="education_2">
						<option>Ingen</option>
						<?php echo display_educations($educations); ?>
					</select>

					<label for="education_3">Utbildning 3:e prio</label>
					<select name="education_3" id="education_3">
						<option>Ingen</option>
						<?php echo display_educations($educations); ?>
					</select>

					<label for="basic_eligibility">Grundl&auml;ggande beh&ouml;righet</label>
					<select name="basic_eligibility" id="basic_eligibility">
						<option>Ja</option>
						<option>Nej</option>
						<option>Dispens</option>
					</select>

					<input type='hidden' id='personal_number' name='personal_number' value='<?php echo $personal_number; ?>' />
					<input type='hidden' id='admission_id' name='admission_id' value='<?php echo $admission_id; ?>' />
					<input type="submit" name="submit_application" value="spara" />


				</fieldset>	
			</form>
		</div>
	</body>
	</html>
