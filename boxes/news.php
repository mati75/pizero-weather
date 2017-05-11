<h2>news</h2>
<?php
$myXMLData = file_get_contents('http://feeds.ilpost.it/ilpost?format=xml');

$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
$news_item = $xml->channel->item;
//print_r($news_item);
echo "<ul>";
foreach ($news_item as $news) {
	echo '<li>'.$news->title.'</li>';
}
echo "</ul>";
?>
