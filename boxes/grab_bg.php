<?php
// page bg is something like:  http://miniature-calendar.com/wp-content/uploads/2017/12/171201fri.jpg

//$url = 'http://miniature-calendar.com/feed';
$url2 = 'http://d3cbihxaqsuq0s.cloudfront.net';

if(!isset($_SESSION['first_run']) || $_SESSION['first_run'] == 0) {
	if (isset($url)) {
		$_SESSION['first_run'] = 1;
	  $rss = new DOMDocument();
	  $rss->load($url);
	  $feed = array();
		$node = $rss->getElementsByTagName('item')[0];
	  $item = $node->getElementsByTagName('encoded')->item(0)->nodeValue;

		//print_r($item);
		$xpath = new DOMXPath(@DOMDocument::loadHTML($item));
		$bgfullurl = str_replace('-250x250','',$xpath->evaluate("string(//img/@src)"));
		//print_r($bgfullurl);
	}
	else if (isset($url2)) {
		$_SESSION['first_run'] = 0;
	  $rss = simplexml_load_file($url2);
		//print_r($rss);
	  $rss = $rss->Contents[rand(1,20)];

		//print_r($rss);
		$bgfullurl = $url2.'/'.$rss->Key[0];
		//print_r($bgfullurl);
	}


	$time = getdate();
	if ( $time['hours'] == 0 ) { $_SESSION['first_run'] = 0; }
?>
	<script>
		document.getElementById('pagecontent').setAttribute("style", "background-image: url('<?php echo $bgfullurl ?>');");
	</script>
<?php
}
?>
