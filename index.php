<!DOCTYPE html>
<html>
  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pizero Display Panel</title>
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed:400,700" rel="stylesheet">
		<link href="css/weather-icons.min.css" rel="stylesheet" type="text/css">
		<link href="css/weather.css" rel="stylesheet" type="text/css">
	</head>
  <body>
		<div id="pagecontent">
			<div class="col col1 width33 left">

				<div id="timecontainer"></div>

				<div id="weathercontainer"></div>

			</div>

			<div class="col col2 width33 left">

				<div id="insidecontainer"></div>

				<div id="chartcontainer"></div>

			</div>

			<div class="col col2 width33 left">

				<div id="forecastcontainer"></div>

			</div>

		</div>
		<script src="js/jquery-3.2.0.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.src.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="js/pizero-weather.js"></script>
	</body>
</html
