<?php
// we have a local folder, choose a random image in it:
$dir = "backgrounds/";
$images = scandir($dir);
$i = rand(2, sizeof($images)-1);
?>
	<script>
		document.getElementById('pagecontent').setAttribute("style", "background-image: url('<?php echo $dir.'/'.$images[$i] ?>');");
	</script>
<?php
}
?>
