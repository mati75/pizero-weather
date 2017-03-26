<!DOCTYPE html>
<html>
  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Weather for Milan,IT</title>
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed:400,700" rel="stylesheet">
		<link href="css/owfont-regular.css" rel="stylesheet" type="text/css">
		<link href="css/weather.css" rel="stylesheet" type="text/css">
	</head>
  <body>
		<div id="pagecontent">
			<div class="col col1 width33 left">

				<div id="timecontainer">
					<?php
					$time = getdate();
					if ( $time['hours'] < 10 )
						$time['hours'] = '0'.$time['hours'];
					if ( $time['minutes'] < 10 )
						$time['minutes'] = '0'.$time['minutes'];
					echo "<h2>".$time['hours'].":".$time['minutes']."</h2>";
					echo '<p>'.$time['weekday'].', '.$time['mday'].' '.$time['month'].' '.$time['year'].'</p>';
					?>

				</div>

				<div id="insidecontainer">
					<h2>inside</h2>
				</div>

			</div>

			<div class="col col2 width33 left">

				<div id="weathercontainer">
					<h2>outside</h2>
					<?php
					$city="Milan";
					$country="IT"; //Two digit country code
					$appid="ba2eb32ada1a3e3b489cadc95e2a9975";
					$url="http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=metric&cnt=7&lang=en&appid=".$appid;
					$json=file_get_contents($url);
					$data=json_decode($json,true);
					//Get current Temperature in Celsius
					//echo "<time>".$time['hours'].":".$time['minutes']." <i class=\"owf owf-".$data['weather'][0]['id']."\"></i></time>";
					echo "<time>".$data['main']['temp']."&deg;C <i class=\"owf owf-".$data['weather'][0]['id']."\"></i></time>";
					echo "";
					echo "<ul>";
					echo "<li><strong>Current Weather Condition: </strong><span>".$data['weather'][0]['description']."</span></li>";
					echo "<li><strong>Min / Max temp: </strong><span>".$data['main']['temp_min']." / ".$data['main']['temp_max']."&deg;C</span></li>";
					echo "<li><strong>Pressure: </strong><span>".$data['main']['pressure']."mbar</span></li>";
					echo "<li><strong>Humidity: </strong><span>".$data['main']['humidity']."%</span></li>";
					echo "<li><strong>Wind Speed: </strong><span>".$data['wind']['speed']." km/h</span></li>";
					echo "</ul>";
					?>
				</div>

			</div>

			<div class="col col2 width33 left">

				<div id="forecastcontainer">
					<h2>forecast</h2>
				</div>

			</div>

		</div>
	</body>
</html
