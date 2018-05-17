<?php
// we have a local folder, choose a random image in it:
$dir = "backgrounds/";
if(scandir('../'.$dir) == false) {
	echo 'falZo';
	die();
} else {
	$images = scandir('../'.$dir);
	$i = rand(2, sizeof($images)-1);
}
?>
	<script>
		document.getElementById('pagecontent').setAttribute("style", "background-image: url('<?php echo $dir.$images[$i] ?>');");
		document.getElementById('blurrything').setAttribute("style", "background-image: url('<?php echo $dir.$images[$i] ?>');");
	</script>
