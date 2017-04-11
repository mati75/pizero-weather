<h2>7 day forecast</h2>
<?php
$city="Barona";
$country="IT"; //Two digit country code
$appid="d72cab79ae210e53";
$url="http://api.wunderground.com/api/".$appid."/forecast10day/q/".$country."/".$city.".json";

// example:
// http://api.wunderground.com/api/d72cab79ae210e53/forecast10day/q/CA/San_Francisco.json

$json=file_get_contents($url);
$data=json_decode($json,true);
$data = $data['forecast']['simpleforecast'];
// print_r($data);

foreach ($data['forecastday'] as $key => $day) {
if ($key<7): ?>
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
