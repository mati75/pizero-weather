<h2>inside</h2>
<?php
$temperature = `gpio -x bmp180:100 aread 100` / 10 ;
$pressure = `gpio -x bmp180:100 aread 101` / 10 ;
//$humidity = '';
?>
<h3 class="temp" data-temp="<?php echo $temperature; ?>">
	<?php echo $temperature; ?>&deg;
	<small>temperature</small>
</h3>
<h3 class="press" data-press="<?php echo $pressure; ?>">
	<?php echo $pressure; ?>mbar
	<small>pressure</small>
</h3>
<!--h3 class="humi">
	<?php //echo $humidity; ?>%perc;
	<small>humidity</small>
</h3-->
