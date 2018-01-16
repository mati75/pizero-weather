<?php
$doc = new DOMDocument('1.0', 'UTF-8');
libxml_use_internal_errors(true);
$doc->loadHTMLFile ('http://gtsportraces.com/index.php');
foreach ($doc->getElementsByTagName('section') as $node) {
		$gtsportraces_html = $doc->saveHtml($node);
}

/*
$doc2 = new DOMDocument('1.0', 'UTF-8');
$doc2->loadHTMLFile ('https://www.kudosprime.com/gts/stats.php?profile=2251088');
$xpath = new DOMXpath($doc2);

$expression = './/div[contains(concat(" ", normalize-space(@class), " "), " stat_entry ")]';
foreach ($xpath->evaluate($expression) as $div) {
		$kudosprime_html = $doc2->saveHtml($div);
}
*/

//echo $kudosprime_html;
?>
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-gb"
      lang="en-gb" itemscope itemtype="http://schema.org/Article">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<base href="https://gtsportraces.com/" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<!-- link rel="stylesheet" href="https://gtsportraces.com/templates/gtsport/css/template.css" type="text/css"/ -->
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,700" rel="stylesheet">

		<style>
		*{margin:0;padding:0;}
		body{min-height:100%;color:#FFF;}
		body{font-family:'Roboto', sans-serif;font-size:12px;background-color:#000;background-size:cover;width:100%;overflow-x:hidden;}
		h1,h2,h3,h4,h5{font-family:'Roboto Condensed', sans-serif;margin:0;padding:0;}
		div,section,article{box-sizing:border-box;}
		.details{background-color:rgba(20, 20, 20, .95);position:absolute;z-index:9;top:325px;width:calc(100% - 30px);bottom:0;opacity:0;transition:opacity ease-in-out 300ms;overflow:hidden;-moz-user-select:none;user-select:none;pointer-events:none;}
		.details .content{padding:20px;text-align:center;}
		.details .content img{width:28px;height:auto;}
		.daily:nth-child(3),.daily:nth-child(5){padding-left:0;}
		article,section{display:block;}
		*{margin:0;padding:0;}
		a{text-decoration:none;transition:color 350ms ease-out;list-style:none;}
		img{max-width:100%;}
		.btn,.btn-close{font-size:10px;border:solid 1px #333;color:#666;cursor:pointer;text-decoration:none;}
		.btn:hover,.btn-close:hover,.btn-close:focus,.btn:focus{background-color:rgba(0,0,0,.5);color:#666;box-shadow:none;}
		.race{background-color:rgba(20, 20, 20, .9);border-radius:2px;box-shadow:0 5px 10px rgba(0, 0, 0, .7);color:#B7B7B7;}
		.race .title h3{text-align:right;text-transform:uppercase;font-size:20px;font-weight:700;text-shadow:0 0 3px #000;}
		.carClass h2{font-size:52px;margin:200px 0 0;font-weight:700;text-shadow:2px 2px 0 #000;line-height:52px;}
		.track{font-size:16px;}
		.track-image{height:325px;padding:10px 20px 20px;background-size:cover;color:#FFF;position:relative;background-position:center;}
		h4{color:#FFF;font-size:18px;}
		h5{color:#FFF;font-size:36px;font-weight:700;}
		h6{color:#FFF;font-size:24px;margin-top:10px;font-weight:700;}
		h6 span{font-size:14px;}
		.race-entry{position:absolute;background-color:rgba(0,0,0,.8);border-radius:30px;padding:5px 10px;}
		.race-entry span{color:#00d95a;font-size:30px;position:absolute;top:-7px;}
		.race-info{padding:20px;text-align:center;}
		.start-time,.race-info-details{margin:0 -20px;}
		.start-time .col-8{text-align:left;}
		.start-time .col-8,.start-time .col-4{border-bottom:solid 1px #333;padding:0 20px 20px 20px;}
		.start-time .col-4{padding-left:0;}
		.race-info-details .col-3,.race-info-details .col-4,.race-info-details .col-5{padding-top:20px;}
		@media (max-width: 1200px){
		.carClass h2{font-size:44px;}
		}
		div#robcontainer {
    width: 100%;
    max-width: 960px;
    margin: 0 auto;
		position: relative;
		top: 50%;
		transform: translateY(-50%);
		}
		</style>
</head>
<body>
	<div id="robcontainer">
		<?php echo $gtsportraces_html; ?>
	</div>
</body>
</html>
