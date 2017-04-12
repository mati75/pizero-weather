var reloadBtn = jQuery('#reload');
var loadblock = function(target,blockname,interval) {

	jQuery(target).load('boxes/'+blockname);

	setInterval(function(){
		jQuery(target).load('boxes/'+blockname);
		console.debug('block '+blockname+' loaded.');
	}, interval*60000);

}


jQuery(document).ready(function(){
	//reloadBtn.className = "rotate";
	loadblock('#timecontainer','clock.php',1);
	loadblock('#insidecontainer','inside.php',1);
	loadblock('#chartcontainer','chart.php',10);
	loadblock('#weathercontainer','outside.php',30);
	loadblock('#forecastcontainer','forecast.php',120);

	reloadBtn.click(function(){
		reloadBtn.addClass("rotate");
		window.location.reload();
	})

});
jQuery( window ).on("load", function() {
	reloadBtn.removeClass("rotate");
});
