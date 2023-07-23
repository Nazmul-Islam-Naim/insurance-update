$(function () {
	lifeStage();
});

/*
* take user from user table and take performance from customer table.
*/

function lifeStage(){
	var urlPath = null;
	if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
		urlPath = "http://" + window.location.host + "/utility/lifeStage";
	} else {
		urlPath = "https://" + window.location.host + "/utility/lifeStage";
	}

	$.ajax({
		type: "GET",
		url: urlPath,
		dataType: "json",
		success: function (response) {
			lifeStageResponse(response);
		}
	});
}

// user array
function lifeStageCategory(response){
	const category = [];
	const clientLifeStages = Object.values(response.lifeStages);
	clientLifeStages.forEach(element => {
		category.push(element);
	});
	return category;
}
// performance array
function clients(response){
	const client = [];
	const clientValues = Object.values(response.clients);
	clientValues.forEach(element => {
		client.push(element);
	});
	return client;
}

function lifeStageResponse(response){
	var options = {
		chart: {
			height: 300,
			type: 'bar',
			dropShadow: {
				enabled: true,
				opacity: 0.1,
				blur: 5,
				left: -10,
				top: 10
			},
		},
		plotOptions: {
			bar: {
				dataLabels: {
					position: 'top', // top, center, bottom
				},
			}
		},
		dataLabels: {
			enabled: true,
			formatter: function (val) {
				return val;
			},
			offsetY: -20,
			style: {
				fontSize: '12px',
				colors: ["#2e323c"]
			}
		},
		series: [{
			name: 'Inflation',
			data: clients(response)
		}],
		xaxis: {
			categories: lifeStageCategory(response),
			position: 'top',
			labels: {
				offsetY: -18,
			},
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			},
			crosshairs: {
				fill: {
					type: 'gradient',
					gradient: {
						colorFrom: '#4285F4',
						colorTo: '#95c5ff',
						stops: [0, 100],
						opacityFrom: 0.4,
						opacityTo: 0.5,
					}
				}
			},
			tooltip: {
				enabled: true,
				offsetY: -35,
			}
		},
		fill: {
			gradient: {
				shade: 'light',
				type: "horizontal",
				shadeIntensity: 0.25,
				gradientToColors: undefined,
				inverseColors: true,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [50, 0, 100, 100]
			},
		},
		yaxis: {
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false,
			},
			labels: {
				show: false,
				formatter: function (val) {
					return val;
				}
			}
		},
		title: {
			text: 'Monthly Inflation in Argentina, 2018',
			floating: true,
			offsetY: 320,
			align: 'center',
			style: {
				color: '#2e323c'
			}
		},
		grid: {
		borderColor: '#47496f',
		strokeDashArray: 5,
		xaxis: {
		  lines: {
			show: true
		  }
		},   
		yaxis: {
		  lines: {
			show: false,
		  } 
		},
		padding: {
		  top: 0,
		  right: 0,
		  bottom: 0,
		  left: 0
		}, 
	  },
		colors: ['#4285F4', '#2b86f5', '#63a9ff', '#95c5ff', '#c6e0ff'],
	}
	var chart = new ApexCharts(
		document.querySelector("#basic-column-graph-datalables"),
		options
	);
	chart.render();
}


