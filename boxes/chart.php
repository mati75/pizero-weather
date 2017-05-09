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
	var readInterval = 60; // intervallo in minuti
	Highcharts.chart('chart_temp', {
			chart: {
					type: 'spline',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
			},
			title: {
					text: ''
			},
			xAxis: {
					type: 'datetime',
					tickPixelInterval: 60
			},
			yAxis: {
					title: {
							text: 'Temp.'
					},
					tickPixelInterval: 10,
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
			plotOptions: {
				marker: {
          	enabled: false
        },
				series: {
          color: '#FFc107'
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
						var data = [];
						data.push(<?php echo file_get_contents('/var/www/html/pizero-weather/logs/temp_log.json'); ?>)
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
			},
			title: {
					text: ''
			},
			xAxis: {
					type: 'datetime',
					tickPixelInterval: 60,
					plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
					}]

			},
			yAxis: {
					title: {
							text: 'Pressure'
					},
					tickPixelInterval: 10,
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
			plotOptions: {
				marker: {
						enabled: false
				},
				series: {
						color: '#5677fc'
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
						var data = [];
						data.push(<?php echo file_get_contents('/var/www/html/pizero-weather/logs/press_log.json'); ?>)
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
