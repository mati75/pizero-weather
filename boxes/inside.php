<h2>inside</h2>
<?php
$temperature = `gpio -x bmp180:100 aread 100` / 10 ;
$pressure = `gpio -x bmp180:100 aread 101` / 10 ;
?>
<time><?php echo $temperature; ?>&deg;</time>
<time><?php echo $pressure; ?>&deg;</time>
