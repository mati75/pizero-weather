<?php
function httpPost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v)
   {
      $postData .= $k . '='.$v.'&';
   }
   $postData = rtrim($postData, '&');

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $output=curl_exec($ch);

    curl_close($ch);
    return $output;

}
$params = array(
   "job" => "3",
   "user_no" => "2251088"
);

$profiledata = httpPost("https://www.gran-turismo.com/us/api/gt7sp/profile/",$params);
$GTapi = json_decode($profiledata);

//print_r($GTapi->stats);

switch ($GTapi->stats->driver_class) {
		case "1":
			$DR= "E";
			break;
		case "2":
			$DR= "D";
			break;
		case "3":
			$DR= "C";
			break;
		case "4":
			$DR= "B";
			break;
		case "5":
			$DR= "A";
			break;
		case "6":
			$DR= "S";
			break;
		default:
			echo "N/A";
}

if($GTapi->stats->manner_point < 10) {
	$SR = "E";
} elseif($GTapi->stats->manner_point < 20) {
	$SR = "D";
} elseif($GTapi->stats->manner_point < 40) {
	$SR = "C";
} elseif($GTapi->stats->manner_point < 65) {
	$SR = "B";
} elseif($GTapi->stats->manner_point < 80) {
	$SR = "A";
} elseif($GTapi->stats->manner_point < 100) {
	$SR = "S";
} else {
	$SR = "N/A";
}

$SRpts= $GTapi->stats->manner_point;
$DRpts= $GTapi->stats->driver_point;

?>

<?php //print_r($GTapi->stats); ?>
				<div class="infopanel col-4">
					<ul class="race">
						<li class="infopanel-header col-12"><img src="https://s3.amazonaws.com/gt7sp-prod/photo/20/22/58/<?php echo str_replace('-','_',$GTapi->stats->profile_photo_id); ?>.jpg" width="75" height="75" /><h2>Stats for<br /> <span>Meuro078</span></h2></li>

						<li class="col-4">Races</li>
						<li class="col-4">DR</li>
						<li class="col-4">SR</li>

						<li class="col-4 ico_RACE"><h3><?php echo $GTapi->stats->race_count; ?></h3></li>
						<li class="col-4 ico_DR"><span><?php echo $DR; ?></span></li>
						<li class="col-4 ico_SR"><span><?php echo $SR; ?></span></li>

					</ul>
				</div>

				<div id="DRgraph" class="graph DR-graph col-4">
					Loading DR data...
					<?php include('gtraces_graphs.php'); ?>
				</div>
				<div id="SRgraph" class="graph SR-graph col-4">
					Loading SR data...
				</div>
