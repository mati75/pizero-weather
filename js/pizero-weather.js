var reloadBtn = jQuery('#reload');
var loadblock = function(target,blockname,interval) {

	jQuery(target).load('boxes/'+blockname);

	setInterval(function(){
		jQuery(target).load('boxes/'+blockname);
		console.debug('block '+blockname+' loaded.');
		if (blockname == 'outside.php') {
			ColorTemp('weathercontainer');
		}
	}, interval*60000);

}


var ColorTemp = function(target) {
	var c = document.getElementById(target);
	var t = $('#'+target+' .temp_value').text();
	var x0 = (t + 30) * 5;
	var x1 = x0 + 10;
	var hue = 30 + 350 * (30 - t) / 60;
	c.style.backgroundColor = 'hsl(' + [hue, '100%', '50%'] + ')';
}

jQuery(document).ready(function(){
	//reloadBtn.className = "rotate";
	loadblock('#timecontainer','clock.php',1);
	loadblock('#newscontainer','news.php',30);
	loadblock('#chartcontainer','chart.php',30);
	loadblock('#weathercontainer','outside.php',30);
	loadblock('#forecastcontainer','forecast.php',60);

	reloadBtn.click(function(){
		reloadBtn.addClass("rotate");
		window.location.reload();
	})


	setInterval(function(){
		listUpcomingEvents();
	}, 120*60000);

});
jQuery(window).on("load", function() {
	reloadBtn.removeClass("rotate");
	ColorTemp('weathercontainer');
});
