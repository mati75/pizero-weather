<?php // logs temperature & pressure to file: runs every hour via cron
$temperature = `gpio -x bmp180:100 aread 100` / 10 ;
$pressure = `gpio -x bmp180:100 aread 101` / 10 ;
$timestamp = time()*1000;
$file_temp = '/var/www/html/pizero-weather/logs/temp_log.json';
$file_press = '/var/www/html/pizero-weather/logs/press_log.json';

// get existing data
$current_temp = file_get_contents($file_temp);
// append data to file (max 25 lines)
$current_temp .= "{x: $timestamp, y: $temperature},\n";
$ArrT = explode("\n", $current_temp);
$ArrT = array_slice($ArrT, -25);
//var_dump($ArrT);
$dataT=implode("\n",$ArrT);
// remove last ,
$search = ',';
$replace = '';
$dataT = strrev(implode(strrev($replace), explode(strrev($search), strrev($dataT), 2)));
// re-write data to file
file_put_contents($file_temp, $dataT);
echo '<pre>';
var_dump($dataT);
echo '</pre>';

echo "<br><br><br>";

// get existing data
$current_press = file_get_contents($file_press);
// append data to file (max 25 lines)
$current_press .= "{x: $timestamp, y: $pressure},\n";
$ArrP = explode("\n", $current_press);
$ArrP = array_slice($ArrP, -25);
//var_dump($ArrP);
$dataP=implode("\n",$ArrP);
// remove last ,
$search = ',';
$replace = '';
$dataP = strrev(implode(strrev($replace), explode(strrev($search), strrev($dataP), 2)));
// re-write data to file
file_put_contents($file_press, $dataP);
echo '<pre>';
var_dump($dataP);
echo '</pre>';

 ?>
