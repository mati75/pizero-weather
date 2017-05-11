<h2>Outside</h2>
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
echo "<time><span class=\"temp_value\">". number_format($data['temp_c'], 1, '.', '')."</span>&deg; <i class=\"wi wi-wu-".$data['icon']."\"></i>";
echo "<small>".$data['weather']."</small>";
echo "</time>";
echo "<ul>";
echo "<li><strong>Feels like: </strong><span>".$data['feelslike_c']."&deg;</span></li>";
echo "<li><strong>Rainfall: </strong><span>".$data['precip_today_metric']."mm</span></li>";
echo "<li><strong>Humidity: </strong><span>".$data['relative_humidity']."</span></li>";
echo "<li><strong>Wind: </strong><span>".$data['wind_kph']."km/h</span></li>";
echo "</ul>";

$url_alert="http://api.wunderground.com/api/".$appid."/alerts/q/".$country."/".$city.".json";
$json_alert=file_get_contents($url_alert);
$data_alert=json_decode($json_alert,true);
$alert1 = $data_alert['alerts'][0];
//var_dump($data_alert);
echo "<div class=\"alerts level_".$alert1['level_meteoalarm']."\"><p>";
echo "<strong>".$alert1['wtype_meteoalarm_name']."</strong> - ".$alert1['message'];
echo "</p></div>";
?>
