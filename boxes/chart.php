<h2>Inside Temp.</h2>
<div id="chart_temp" style="height:100px"></div>
<h2>Pressure</h2>
<div id="chart_press" style="height:100px"></div>
<?php
$temperature = `gpio -x bmp180:100 aread 100` / 10 ;
$temperature = $temperature - 2;
$pressure = `gpio -x bmp180:100 aread 101` / 10 ;
//$humidity = '';
?>
<h3 class="temp" data-temp="<?php echo $temperature; ?>">
	<?php echo $temperature; ?>&deg;
</h3>
<h3 class="press" data-press="<?php echo $pressure; ?>">
	<?php echo $pressure; ?><small>mbar</small>
</h3>
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
					tickPixelInterval: 60,
					dateTimeLabelFormats: {
            day: '%e %b'
        	}
			},
			yAxis: {
					title: {
							text: '',
					},
					tickPixelInterval: 10
			},
			tooltip: {
					formatter: function () {
							return '<b>' + this.series.name + '</b><br/>' +
									Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
									Highcharts.numberFormat(this.y, 2);
					}
			},
			plotOptions: {
				series: {
					marker: {
							enabled: false,
					},
          color: '#e51c23',
					lineWidth : 4
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
						data.push(<?php echo file_get_contents('../logs/temp_log.json'); ?>)
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
					backgroundColor: '#ffffff',
			},
			title: {
					text: ''
			},
			xAxis: {
					type: 'datetime',
					tickPixelInterval: 60,
					dateTimeLabelFormats: {
            day: '%e %b'
        	}
			},
			yAxis: {
					title: {
							text: ''
					},
					tickPixelInterval: 10,
			},
			tooltip: {
					formatter: function () {
							return '<b>' + this.series.name + '</b><br/>' +
									Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
									Highcharts.numberFormat(this.y, 2);
					}
			},
			plotOptions: {
				series: {
						marker: {
								enabled: false,
						},
						color: '#5677fc',
						lineWidth : 4
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
						data.push(<?php echo file_get_contents('../logs/press_log.json'); ?>)
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
