<div class="forecast-12hrs width50 left">
	<h2>12 hrs forecast</h2>
	<?php
	$city="Barona";
	$country="IT"; //Two digit country code
	$appid="d72cab79ae210e53";
	$url_10day="http://api.wunderground.com/api/".$appid."/forecast10day/q/".$country."/".$city.".json";
	$url_hourly="http://api.wunderground.com/api/".$appid."/hourly/q/".$country."/".$city.".json";

	// example:
	// http://api.wunderground.com/api/d72cab79ae210e53/forecast10day/q/IT/Barona.json
	// http://api.wunderground.com/api/d72cab79ae210e53/hourly/q/IT/Barona.json

	$json_hourly=file_get_contents($url_hourly);
	$data_hourly=json_decode($json_hourly,true);
	$data_hourly = $data_hourly['hourly_forecast'];

	foreach ($data_hourly as $key => $day) {
	//if ($key<5):
	if ($key % 3 == 0 && $key < 15):?>
		<ul class="forecast-hour">
			<li class="text left">
				<strong><?php echo $day['FCTTIME']['hour']; ?> <?php echo $day['FCTTIME']['ampm']; ?></strong>
				<small><?php echo $day['temp']['metric'] ?>&deg;</small>
				<span><?php echo $day['wx'] ?></span>
				<?php echo "<i class=\"wi wi-wu-".$day['icon']."\"></i>"; ?><small> <?php echo $day['pop']; ?>%</small>
			</li>
		</ul>
	<?php
	endif;
	}

	?>
</div>
<div class="forecast-5day width50 right">
	<h2>5 day forecast</h2>
	<?php
	$json_10day=file_get_contents($url_10day);
	$data_10day=json_decode($json_10day,true);
	$data_10day = $data_10day['forecast']['simpleforecast'];
	// print_r($data_10day);

	foreach ($data_10day['forecastday'] as $key => $day) {
	if ($key> 0 && $key<6): ?>
		<ul class="forecast-day">
			<li class="text left">
				<strong><?php echo gmdate("D, j F Y", $day['date']['epoch']); ?></strong><br>
				<span><?php echo $day['high']['celsius'] ?>&deg; | <?php echo $day['low']['celsius'] ?>&deg; - <?php echo $day['conditions'] ?></span>
			</li>
			<li class="icon left"><?php echo "<i class=\"wi wi-wu-".$day['icon']."\"></i>"; ?><small><?php echo $day['pop']; ?>%</small></li>
		</ul>
	<?php
	endif;
	}
	?>
</div>
