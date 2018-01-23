<?php
/*
function httpPost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v)
   {
      $postData .= $k . '='.$v.'&';
   }
   $postData = rtrim($postData, '&');

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $output=curl_exec($ch);

    curl_close($ch);
    return $output;

}
*/

$begin_M = date('n',strtotime("-1 month"));
if ($begin_M == '12') {
	$begin_Y = date('Y',strtotime("-1 year"));
} else {
	$begin_Y = date('Y');
}

$params = array(
	"job" => "12",
	"month_begin" => $begin_M,
	"month_end" => date('n'),
	"year_begin" => $begin_Y,
	"year_end" => date('Y'),
	"user_no" => "2251088"
);

$profiledata = httpPost("https://www.gran-turismo.com/us/api/gt7sp/profile/",$params);
$GTapi = json_decode($profiledata);

$i = 0;
$l = 0;
$GTdata_DR = '';
$GTdata_SR = '';
foreach ($GTapi->stats_history as $GTdata) {
	foreach ($GTdata->stats12 as $GTdata_stats) {
		if ($GTdata_stats != '0'){
			$GTdata_DR .= "{x: ".$i.", y: ".$GTdata_stats."},\n";
			$i++;
		}
	}
	foreach ($GTdata->stats13 as $GTdata_stats) {
		if ($GTdata_stats != '0'){
			$GTdata_SR .= "{x: ".$l.", y: ".$GTdata_stats."},\n";
			$l++;
		}
	}
}


$GTdata_DR = substr($GTdata_DR, 0, -2);
$GTdata_SR = substr($GTdata_SR, 0, -2);

// echo $GTdata_DR;
// echo "\n\n\n---------------\n\n\n";
// echo $GTdata_SR;

//print_r($GTapi->stats_history);
?>
<script>
$(document).ready(function () {
	Highcharts.setOptions({
			global: {
					useUTC: false
			}
	});


	Highcharts.chart('DRgraph', {
			chart: {
					type: 'area',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
			},
			title: {
					text: '<span class="chartTitle">DR</span><span class="chartValue"><?php echo $DRpts; ?></span>',
					useHTML: true,
			},
			xAxis: {
				title: {
						text: '',
				},
				tickPixelInterval: 25,
				gridLineWidth: 0,
			},
			yAxis: {
					title: {
							text: '',
					},
					tickPixelInterval: 25,
					gridLineWidth: 0,
					ceiling: 70000,
					plotBands: [{
						color: '#FF300066', // Color value
						from: 0, // Start of the plot band
						to: 2000 // End of the plot band
					},{
						color: '#FF600066', // Color value
						from: 2000, // Start of the plot band
						to: 4000 // End of the plot band
					},{
						color: '#FFA00066', // Color value
						from: 4000, // Start of the plot band
						to: 10000 // End of the plot band
					},{
						color: '#FFE00066', // Color value
						from: 10000, // Start of the plot band
						to: 30000 // End of the plot band
					},{
						color: '#E0FF0066', // Color value
						from: 30000, // Start of the plot band
						to: 50000 // End of the plot band
					},{
						color: '#A0FF0066', // Color value
						from: 50000, // Start of the plot band
						to: 70000 // End of the plot band
					}]
			},
			plotOptions: {
				series: {
					marker: {
							enabled: false,
					},
          color: '#ffffff33',
					lineWidth : 2
        }
			},
			legend: {
					enabled: false
			},
			exporting: {
					enabled: false
			},
			series: [{
					name: 'DR points',
					data: (function () {
						var data = [];
						data.push(<?php echo $GTdata_DR; ?>)
						return data;
					}())
			}]
	});



	Highcharts.chart('SRgraph', {
			chart: {
					type: 'area',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
			},
			title: {
				text: '<span class="chartTitle">SR</span><span class="chartValue"><?php echo $SRpts; ?></span>',
				useHTML: true,
			},
			xAxis: {
				title: {
						text: '',
				},
				tickPixelInterval: 50,
				gridLineWidth: 0,
			},
			yAxis: {
					title: {
							text: '',
					},
					tickPixelInterval: 25,
					gridLineWidth: 0,
					ceiling: 100,
					plotBands: [{
						color: '#FF300066', // Color value
						from: 0, // Start of the plot band
						to: 10 // End of the plot band
					},{
						color: '#FF600066', // Color value
						from: 10, // Start of the plot band
						to: 20 // End of the plot band
					},{
						color: '#FFA00066', // Color value
						from: 20, // Start of the plot band
						to: 40 // End of the plot band
					},{
						color: '#FFE00066', // Color value
						from: 40, // Start of the plot band
						to: 65 // End of the plot band
					},{
						color: '#E0FF0066', // Color value
						from: 65, // Start of the plot band
						to: 80 // End of the plot band
					},{
						color: '#A0FF0066', // Color value
						from: 80, // Start of the plot band
						to: 120 // End of the plot band
					}]
			},
			plotOptions: {
				series: {
					marker: {
							enabled: false,
					},
          color: '#ffffff33',
					lineWidth : 2
        }
			},
			legend: {
					enabled: false
			},
			exporting: {
					enabled: false
			},
			series: [{
					name: 'SR points',
					data: (function () {
						var data = [];
						data.push(<?php echo $GTdata_SR; ?>)
						return data;
					}())
			}]
	});





});
</script>
