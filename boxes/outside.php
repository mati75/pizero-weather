<h2>outside</h2>
<?php
$city="Milan";
$country="IT"; //Two digit country code
$appid="ba2eb32ada1a3e3b489cadc95e2a9975";
$url="http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=metric&cnt=7&lang=en&appid=".$appid;
$json=file_get_contents($url);
$data=json_decode($json,true);
//Get current Temperature in Celsius
echo "<time>". number_format($data['main']['temp'], 1, '.', '')."&deg;C <i class=\"wi wi-owm-".$data['weather'][0]['id']."\"></i></time>";
echo "";
echo "<ul>";
echo "<li><strong>Current Weather Condition: </strong><span>".$data['weather'][0]['description']."</span></li>";
echo "<li><strong>Min / Max temp: </strong><span>".$data['main']['temp_min']." / ".$data['main']['temp_max']."&deg;C</span></li>";
echo "<li><strong>Pressure: </strong><span>".$data['main']['pressure']."mbar</span></li>";
echo "<li><strong>Humidity: </strong><span>".$data['main']['humidity']."%</span></li>";
echo "<li><strong>Wind Speed: </strong><span>".$data['wind']['speed']." km/h</span></li>";
echo "</ul>";
?>
