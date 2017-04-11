var loadblock = function(target,blockpath,interval) {

	jQuery(target).load(blockpath);

	setInterval(function(){
		jQuery(target).load(blockpath);
		//console.debug('block '+blockpath+' loaded.');
	}, interval*60000);

}

jQuery(document).ready(function(){

	loadblock('#timecontainer','boxes/clock.php',1);
	//loadblock('#gcaldata','js/quickstart.php',1);
	loadblock('#insidecontainer','boxes/inside.php',1);
	loadblock('#chartcontainer','boxes/chart.php',10);
	loadblock('#weathercontainer','boxes/outside.php',30);
	loadblock('#forecastcontainer','boxes/forecast.php',120);

	setInterval(function(){
		listUpcomingEvents();
	}, 30*60000);

});
