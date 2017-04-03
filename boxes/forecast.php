<h2>7 day forecast</h2>
<?php
$city="Milan";
$country="IT"; //Two digit country code
$appid="ba2eb32ada1a3e3b489cadc95e2a9975";
$url="http://api.openweathermap.org/data/2.5/forecast/daily?q=".$city.",".$country."&units=metric&cnt=8&lang=en&appid=".$appid;
$json=file_get_contents($url);
$data=json_decode($json,true);
// print_r($data);

foreach ($data['list'] as $key => $day) {
if ($key>0): ?>
	<ul class="forecast-day">
		<li class="text left">
			<strong><?php echo gmdate("D, j F Y", $day["dt"]); ?></strong><br>
			<?php echo floor($day["temp"]["min"]) ?>&deg; | <?php echo floor($day["temp"]["max"]) ?>&deg; - <?php echo $day["weather"][0]["description"] ?>
			<!-- <pre><?php  var_dump($day); ?></pre> -->
		</li>
		<li class="icon left"><?php echo "<i class=\"wi wi-owm-".$day['weather'][0]['id']."\"></i>"; ?></li>
	</ul>
<?php
endif;
}
?>
