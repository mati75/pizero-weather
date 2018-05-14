<?php
function ping($host) {
	exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
	return $rval === 0;
}

/* check if the host is up
        $host can also be an ip address */
//$host = '192.168.1.110';
$host = $_GET['ip'];
$up = ping($host);


echo "<div id=\"PS4response\" class=\"";
echo $up ? 'online' : 'offline';
echo "\"></div>";
?>
