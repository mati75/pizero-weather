<h2>inside</h2>
<?php
$temperature = `gpio -x bmp180:100 aread 100` / 10 ;
$pressure = `gpio -x bmp180:100 aread 101` / 10 ;
?>
<h3 class="temp">
	<?php echo $temperature; ?>&deg;
	<small>temperature</small>
</h3>
<h3>
	<?php echo $pressure; ?>mbar
	<small>pressure</small>
</h3>
