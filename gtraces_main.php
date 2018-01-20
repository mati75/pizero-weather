<?php
$doc = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$doc->loadHTMLFile ('http://gtsportraces.com/index.php');
foreach ($doc->getElementsByTagName('section') as $node) {
		$gtsportraces_html = $doc->saveHtml($node);
		$gtsportraces_html = str_replace('src="/images/','src="img/',$gtsportraces_html);
}
?>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-gb"
      lang="en-gb" itemscope itemtype="http://schema.org/Article">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <base href="https://gtsportraces.com/" /> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="css/gtraces.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700" rel="stylesheet">
		<script src="js/gtraces.js"></script>
</head>
<body id="gtraces">
	<div id="pagecontent">
		<div id="timecontainer"></div>
		<div id="robcontainer">

			<?php echo $gtsportraces_html; ?>

			<section id="statscontainer" class="stats row">

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

	<div id="checkPS4" class="hidden"></div>

	<script src="js/jquery-3.2.0.min.js"></script>
	<script src="js/highcharts/highcharts.src.js"></script>
	<script src="js/highcharts/exporting.js"></script>
	<script src="js/pizero-weather.js?cb=<?php echo rand(0,9999); ?>"></script>


</body>
</html>
