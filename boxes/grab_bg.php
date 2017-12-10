<?php
// page bg is something like:  http://miniature-calendar.com/wp-content/uploads/2017/12/171201fri.jpg

$url = 'http://miniature-calendar.com/feed';

    $rss = new DOMDocument();
    $rss->load($url);
    $feed = array();
		$node = $rss->getElementsByTagName('item')[0];
    $item = $node->getElementsByTagName('encoded')->item(0)->nodeValue;

		//print_r($item);
		$xpath = new DOMXPath(@DOMDocument::loadHTML($item));
		$bgfullurl = str_replace('-250x250','',$xpath->evaluate("string(//img/@src)"));
		//print_r($bgfullurl);
?>
<script>
	document.getElementById('pagecontent').setAttribute("style", "background-image: url('<?php echo $bgfullurl ?>');");
</script>
