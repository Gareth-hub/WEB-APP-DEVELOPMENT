<?php

function IsNullOrEmptyString($str){
    return (!isset($str) || trim($str) === '');
}

$loadedJson = json_decode(file_get_contents('http://localhost/WAD_Project_V4/index.json'), true);
$actualRegionIndex = 0;

if (isset($_GET["Region"])){
	$actualRegionIndex = $_GET["Region"]; 
}
/*
if(!IsNullOrEmptyString($actualRegionName))
{
	$actualRegionIndex = array_search($actualRegionName, array_column($loadedJson, 'location'));
	echo $actualRegionIndex;
}
*/
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
    <title>Weather App</title>
  </head>
  <body>
	<div class="container-fluid">
			<div class="text-center">
				<div class="row">
					<div class="col-md">
					</div>
					<div class="col-md">
						<div class="title">
							<h1>Weather App</h1>
						</div>
					</div>
					<div class="col-md">
					</div>
				</div>
				<div class="row">
					<div class="col-md"></div>
					<div class="col-md"></div>
					<div class="col-md"></div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="display">
							<div class="display-picture">
								<form method="GET">
									<select name="Region" onChange="reloadPage()">
									<?php
									for($index = 0; $index < sizeof($loadedJson); $index++)
									{
										$row = $loadedJson[$index];
										if($index == $actualRegionIndex)
										{
											echo '<option selected value="' . $index . '">' . $row['location'] . '</option>';
										}
										else{
											echo '<option value="' . $index . '">' . $row['location'] . '</option>';
										}
									}
									?>
									</select>
								</form><br/>
								<?php
									echo '<img src="' . $loadedJson[$actualRegionIndex]['image'] . '" alt="Placeholder" height="333">';
								?>								
							</div>					
							<div class="title2">
								<h2><?php echo $loadedJson[$actualRegionIndex]['location']; ?></h2>
							</div>
							<div class="temperature">
								<b>Temperature</b><br/>
								<?php echo $loadedJson[$actualRegionIndex]['temp']; ?>
							</div>
							<div class="description">
								<b>Description</b><br/>
								<?php echo $loadedJson[$actualRegionIndex]['description']; ?>
							</div>
							<div class="humidity">
								<b>Humidity</b><br/>
								<?php echo $loadedJson[$actualRegionIndex]['humidity']; ?>
							</div>
							<div class="wind-speed">
								<b>Wind Speed</b><br/>
								<?php echo $loadedJson[$actualRegionIndex]['wind speeed']; ?>
							</div>
							<div class="date">
								<b>Current Date</b><br/>
								<?php echo date("d/m/Y") ?>
							</div>
							<div class="time">
								<b>Current Time</b><br/>
								<p><?php $timezone  = 0; //(GMT )
								echo gmdate("H:i:s", time() + 3600*($timezone+date("I")));?><p>
							</div>
						</div>
					</div>
					<div class="col-md-1"><div>
				</div>
			</div>
		</div>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<script language="javascript">	
		reloadPage = function() {
			document.forms[0].submit();
		}		
	</script>
	<script language="javascript">	
		var now = new Date(Date.now());
		var nowFormatted = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
		$("#datetime").text(nowFormatted);
	</script>

  </body>
</html>
