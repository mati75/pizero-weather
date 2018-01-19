<?php
$doc = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$doc->loadHTMLFile ('http://gtsportraces.com/index.php');
foreach ($doc->getElementsByTagName('section') as $node) {
		$gtsportraces_html = $doc->saveHtml($node);
}



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


?>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-gb"
      lang="en-gb" itemscope itemtype="http://schema.org/Article">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<base href="https://gtsportraces.com/" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="http://localhost/pizero-weather/css/gtraces.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="http://localhost/pizero-weather/js/gtraces.js"></script>
</head>
<body>
	<div id="pagecontent">
		<div id="robcontainer">

			<?php echo $gtsportraces_html; ?>

			<section class="stats row">

				<div class="infopanel col-4">
					<ul class="race">
						<li class="infopanel-header col-12"><img src="https://s3.amazonaws.com/gt7sp-prod/photo/20/22/58/<?php echo str_replace('-','_',$GTapi->stats->profile_photo_id); ?>.jpg" width="75" height="75" /><h2>Stats for<br /> <span>Meuro078</span></h2></li>

						<li class="col-4">Races</li>
						<li class="col-4">DR</li>
						<li class="col-4">SR</li>

						<li class="col-4"><h6><?php echo $GTapi->stats->race_count; ?></h6></li>
						<li class="col-4"><h6><?php echo $DR; ?></h6></li>
						<li class="col-4"><h6><?php echo $SR; ?></h6></li>

						<li class="col-4"></li>
						<li class="col-4"><h4><?php echo $GTapi->stats->driver_point; ?></h4></li>
						<li class="col-4"><h4><?php echo $GTapi->stats->manner_point; ?>/99</h4></li>
					</ul>
				</div>

				<div class="graph DR-graph col-4">
					DR
				</div>
				<div class="graph SR-graph col-4">
					SR
				</div>

			</section>
			<!-- es.
			[driver_class] => 4
			[driver_point] => 15483
			[manner_point] => 69
			[race_count] => 212
			[driver_point_up_rate] => 27  ???
			-->

		</div>
	</div>
</body>
</html>
