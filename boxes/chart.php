<h2>Temperature</h2>
<div id="chart_temp" style="height:110px"></div>
<h2>Pressure</h2>
<div id="chart_press" style="height:110px"></div>
<script>
$(document).ready(function () {
	Highcharts.setOptions({
			global: {
					useUTC: false
			}
	});
	var readInterval = 1; // intervallo in minuti
	Highcharts.chart('chart_temp', {
			chart: {
					type: 'spline',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
					events: {
							load: function () {

									// set up the updating of the chart each second
									var series = this.series[0];
									setInterval(function () {
											var tempread = $('h3.temp').attr('data-temp'),
													x = (new Date()).getTime(), // current time
													y = parseFloat(tempread);
											series.addPoint([x, y], true, true);
									}, readInterval*60*1000)
							}
					}
			},
			title: {
					text: ''
			},
			xAxis: {
					type: 'datetime',
					tickPixelInterval: readInterval*1000
			},
			yAxis: {
					title: {
							text: 'Value'
					},
					plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
					}]
			},
			tooltip: {
					formatter: function () {
							return '<b>' + this.series.name + '</b><br/>' +
									Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
									Highcharts.numberFormat(this.y, 2);
					}
			},
			legend: {
					enabled: false
			},
			exporting: {
					enabled: false
			},
			series: [{
					name: 'Temperature',
					data: (function () {
							// generate an array of random data
							var data = [],
									time = (new Date()).getTime(),
									i;

							for (i = -5; i <= 0; i += 1) {
									data.push({
											x: time + i * readInterval * 10000,
											y: getRandomInt(15, 30)
									});
							}
							return data;
					}())
			}]
	});





	Highcharts.setOptions({
			global: {
					useUTC: false
			}
	});
	var readInterval = 1; // intervallo in minuti
	Highcharts.chart('chart_press', {
			chart: {
					type: 'spline',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
					events: {
							load: function () {

									// set up the updating of the chart each second
									var series = this.series[0];
									setInterval(function () {
											var pressread = $('h3.press').attr('data-press'),
													x = (new Date()).getTime(), // current time
													y = parseFloat(pressread);
											series.addPoint([x, y], true, true);
									}, readInterval*60*1000)
							}
					}
			},
			title: {
					text: ''
			},
			xAxis: {
					type: 'datetime',
					tickPixelInterval: readInterval*1000
			},
			yAxis: {
					title: {
							text: 'Value'
					},
					plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
					}]
			},
			tooltip: {
					formatter: function () {
							return '<b>' + this.series.name + '</b><br/>' +
									Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
									Highcharts.numberFormat(this.y, 2);
					}
			},
			legend: {
					enabled: false
			},
			exporting: {
					enabled: false
			},
			series: [{
					name: 'Pressure',
					data: (function () {
							// generate an array of random data
							var data = [],
									time = (new Date()).getTime(),
									i;

							for (i = -5; i <= 0; i += 1) {
									data.push({
											x: time + i * readInterval * 10000,
											y: getRandomInt(970, 1020)
									});
							}
							return data;
					}())
			}]
	});



});

function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min)) + min;
}
</script>
