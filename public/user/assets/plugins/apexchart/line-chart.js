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

  // Line Chart

    if($('#line-chart').length > 0 ){
    var linechart = {
      chart: {
        height: 250,
        type: 'line',
        zoom: {
          enabled: false
        },
        toolbar: {
          show: false,
        }
      },
      colors: ['#ff6000'],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      series: [{
        name: "Amount",
        data: [10, 41, 35, 51, 49, 62, 50, 60, 69, 91, 100, 148]
      }],
      grid: {
        row: {
          colors: ['#f1f2f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      }
    }

    var chart = new ApexCharts(
      document.querySelector("#line-chart"),
      linechart
    );

    chart.render();
    }

    });