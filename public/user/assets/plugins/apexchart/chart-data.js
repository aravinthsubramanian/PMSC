'use strict';

$(document).ready(function() {

	function generateData(baseval, count, yrange) {
		var i = 0;
		var series = [];
		while (i < count) {
			var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
			var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
			var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

			series.push([x, y, z]);
			baseval += 86400000;
			i++;
		}
		return series;
	}
	
	// Chart

	if($('#chart').length > 0) {
	var options = {
			series: [{
				name: "Gigs Sales",
				data: [0, 20, 40, 43, 40, 25, 35, 25, 40, 30, 25, 30, 20]
			},
		],
		colors: ['#ff6000'],
          chart: {
          height: 300,
          type: 'area',
		  toolbar: {
				show: false
			},
          zoom: {
            enabled: false
          }
        },
		markers: {
			size: 3,
		},
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight',
		  width: 3,
        },
		legend: {
			position: 'top',
			horizontalAlign: 'right',
		 },
        grid: {
          show: false,
        },
		yaxis: {
			axisBorder: {
				show: true,
			},
		},
        xaxis: {
          categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			}
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
	}

	new Morris.Donut({
		element: 'donut-chart',
		data: [{
			label: 'New',
			value: 1
		}],
		colors: ['#ff6000'],
		storke: ['#ff6000'],
		resize: true,
		backgroundColor: 'rgba(119, 119, 142, 0.2)',
		labelColor: '#74788d',
	});

});