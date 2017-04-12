<h2>outside</h2>
<?php
$city="Barona";
$country="IT"; //Two digit country code
$appid="d72cab79ae210e53";
$url="http://api.wunderground.com/api/".$appid."/conditions/q/".$country."/".$city.".json";

// example:
// http://api.wunderground.com/api/d72cab79ae210e53/conditions/q/CA/San_Francisco.json

$json=file_get_contents($url);
$data=json_decode($json,true);
//var_dump($data);
$data=$data['current_observation'];
//Get current Temperature in Celsius
$time = getdate();
// echo $time['hours'].'ddd';
if ( $time['hours'] < 7 || $time['hours'] > 20 ) {
	$nightday='night';
} else {
	$nightday='day';
}
echo "<time>". number_format($data['temp_c'], 1, '.', '')."&deg; <i class=\"wi wi-wu-".$data['icon']."\"></i>";
echo "<small>".$data['weather']."</small>";
echo "</time>";
echo "<ul>";
// $data['pressure_trend'] = 0 = steady, gli altri???
if ($data['pressure_trend'] == '0') {$PTrend = 'steady'; }
else if ($data['pressure_trend'] == '+') { $PTrend = 'rising'; }
else if ($data['pressure_trend'] == '-') { $PTrend = 'falling'; }
else { $PTrend = 'error!'; }
echo "<li><strong>Feels like: </strong><span>".$data['feelslike_c']."&deg;</span></li>";
echo "<li><strong>Rainfall: </strong><span>".$data['precip_today_metric']."mm</span></li>";
echo "<li><strong>Pressure: </strong><span>".$data['pressure_mb']."mbar</span></li>";
echo "<li><strong>Trend: </strong><span>".$PTrend."</span></li>";
echo "<li><strong>Humidity: </strong><span>".$data['relative_humidity']."</span></li>";
echo "<li><strong>Wind: </strong><span>".$data['wind_kph']."km/h</span></li>";
echo "</ul>";
?>
