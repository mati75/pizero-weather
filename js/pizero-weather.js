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
			//console.log('PS4 is turned ON');
			if (gtsportracesDiv.is(':empty') == true){
				//console.log(gtsportracesDiv+' is empty');
				gtsportracesDiv.prepend("<iframe src=\"http://gtsportraces.com\" width=\"100%\" height=\"600\" scrolling=\"no\" border=\"0\"></iframe>");
				gtsportracesDiv.removeClass('hidden');
			} else {
				//console.log(gtsportracesDiv+' is NOT empty');
			}
		} else {
			//console.log('PS4 is turned OFF');
			gtsportracesDiv.find('iframe').remove();
			gtsportracesDiv.addClass('hidden');
		}
	}, 5000);


}

var ColorTemp = function(target) {
	var c = document.getElementById(target);
	var t = $('#'+target+' .temp_value').text();
	var x0 = (t + 30) * 5;
	var x1 = x0 + 10;
	var hue = 30 + 350 * (30 - t) / 60;
	c.style.backgroundColor = 'hsla(' + [hue, '100%', '50%'] + ',0.25)';
}

jQuery(document).ready(function(){
	//reloadBtn.className = "rotate";
	loadblock('#timecontainer','clock.php',1);
	loadblock('#newscontainer','news.php',30);
	loadblock('#chartcontainer','chart.php',15);
	loadblock('#weathercontainer','outside.php',30);
	loadblock('#forecastcontainer','forecast.php',60);
	loadblock('#bgcontainer','grab_bg.php',24*60);


	reloadBtn.click(function(){
		reloadBtn.addClass("rotate");
		window.location.reload();
	})


	setInterval(function(){
		listUpcomingEvents();
	}, 120*60000);

	setInterval(function(){
		checkPS4('192.168.1.128');
	}, 3*60000);

});
jQuery(window).on("load", function() {
	reloadBtn.removeClass("rotate");
	ColorTemp('weathercontainer');
});
