<?php
$time = getdate();
if ( $time['hours'] < 10 )
	$time['hours'] = '0'.$time['hours'];
if ( $time['minutes'] < 10 )
	$time['minutes'] = '0'.$time['minutes'];
echo "<h2>".$time['hours'].":".$time['minutes']."</h2>";
echo '<p>'.$time['weekday'].', '.$time['mday'].' '.$time['month'].' '.$time['year'].'</p>';
?>
