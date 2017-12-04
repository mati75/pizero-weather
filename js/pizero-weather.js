var reloadBtn = jQuery('#reload');
var currenthour = '';
var loadblock = function(target,blockname,interval) {

	jQuery(target).load('boxes/'+blockname);

	setInterval(function(){
		currenthour = jQuery('#timecontainer h2 span').text();
		jQuery(target).load('boxes/'+blockname);
		console.debug('block '+blockname+' loaded.');
		if (currenthour < 7 || currenthour > 23) {
			$('body').addClass('dimmed')
		} else {
			$('body').removeClass('dimmed')
		}
		if (blockname == 'outside.php') {
			ColorTemp('weathercontainer');
		}
	}, interval*60000);

}

var checkPS4 = function(ip) {
	$('#checkPS4').load("boxes/check_ip.php?ip="+ip+" #response");
	var gtsportracesDiv = $('#gtsportraces');
	setTimeout(function(){
		if ($('#response').text() == 'online'){
			if (gtsportracesDiv.length == 0){
				gtsportracesDiv.prepend("<iframe src=\"http://gtsportraces.com\" width=\"100%\" height=\"600\" scrolling=\"no\" border=\"0\"></iframe>");
			}
		} else {
			gtsportracesDiv.find('iframe').remove();
			gtsportracesDiv.addClass('hidden');
		}
	}, 2000);


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
	loadblock('#chartcontainer','chart.php',15);
	loadblock('#weathercontainer','outside.php',30);
	loadblock('#forecastcontainer','forecast.php',60);

	reloadBtn.click(function(){
		reloadBtn.addClass("rotate");
		window.location.reload();
	})


	setInterval(function(){
		listUpcomingEvents();
	}, 120*60000);

	setInterval(function(){
		checkPS4('192.168.1.128');
	}, 5*60000);

});
jQuery(window).on("load", function() {
	reloadBtn.removeClass("rotate");
	ColorTemp('weathercontainer');
});
