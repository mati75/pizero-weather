<!DOCTYPE html>
<html>
  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pizero Display Panel</title>
		<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed:400,700" rel="stylesheet">
		<link href="css/weather-icons.min.css" rel="stylesheet" type="text/css">
		<link href="css/loading.css" rel="stylesheet" type="text/css">
		<link href="css/weather.css?cb=<?php echo rand(0,9999); ?>" rel="stylesheet" type="text/css">
	</head>
  <body id="index">
		<div id="pagecontent">
			<div id="bgcontainer" class="hidden"></div>
			<div id="gtsportraces" class="hidden"></div>

			<div class="col col1 width25 left">

				<div id="timecontainer"></div>
				<div id="chartcontainer"></div>
				<div id="weathercontainer"></div>

			</div>

			<div class="col col2 width25 left">

				<div id="gcaldata"><?php include('js/quickstart.php') ?></div>

			</div>

			<div id="forecastcontainer" class="width50 left"></div>

			<div id="reload" class="rotate">
				<span><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><path d="M18,50a32,32,0,0,1,9.38-22.62l-7-7a1.41,1.41,0,0,1,1-2.41H40a2,2,0,0,1,2,2V38.6a1.41,1.41,0,0,1-2.41,1L33,33A24,24,0,0,0,50,74v8A32,32,0,0,1,18,50ZM50,18v8A24,24,0,0,1,67,67l-6.49-6.49a1.45,1.45,0,0,0-2.47,1V80a2,2,0,0,0,2,2H78.5a1.45,1.45,0,0,0,1-2.47l-6.91-6.91A32,32,0,0,0,50,18Z"/></path></svg></span>
			</div>

			<div id="checkPS4">
				<a href="./gtraces_main.php"><img src="./img/ico_PS.svg" /></a>
			</div>
			
			<div id="pageloader"><div></div></div>

		</div>


		<script src="js/jquery-3.2.0.min.js"></script>
		<script src="js/highcharts/highcharts.src.js"></script>
		<script src="js/highcharts/exporting.js"></script>
		<script src="js/pizero-weather.js?cb=<?php echo rand(0,9999); ?>"></script>
	</body>
</html>
