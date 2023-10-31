jQuery(document).ready(function() {
	'use strict';

	Morris.Area({
		element: "area_line_chart",
		behaveLikeLine: true,
		data: [
		       {year: '2019-01-1', x: 1000, y: 1000, z: 500},
			   {year: '2019-01-2', x: 500, y: 2000, z: 5000},
			   {year: '2019-01-3', x: 500, y: 3000, z: 4000},
			   {year: '2019-01-4', x: 1000, y: 1000, z: 500},
			   {year: '2019-01-5', x: 500, y: 2000, z: 5000},
			   {year: '2019-01-6', x: 500, y: 3000, z: 4000},
			   {year: '2019-01-7', x: 1000, y: 1000, z: 500},
			   {year: '2019-01-8', x: 500, y: 2000, z: 5000},
			   {year: '2019-01-9', x: 500, y: 3000, z: 4000},
			   {year: '2019-01-10', x: 1000, y: 1000, z: 500},
			   {year: '2019-01-11', x: 500, y: 2000, z: 5000},
		       {year: '2019-01-12', x: 500, y: 3000, z: 4000},
		       ],
		xkey: 'year',
		ykeys: ['x', 'y', 'z'],
		labels: ['发布任务量', '接手任务量', '放弃任务量'],
		pointSize: 2,//圆点大小
		lineWidth: 0.5,//线粗
		resize: true,
		fillOpacity: 0.5,
		behaveLikeLine: true,
		gridLineColor: '#e0e0e0',
		hideHover: 'auto',
		lineColors: ['rgb(97, 97, 97)', 'rgb(0, 206, 209)', 'rgb(255, 117, 142)']
	}),
	
	Morris.Donut({
		element: "donut_chart",
		data: [{
			label: '商家用户',
			value: 20
		}, {
			label: '刷手用户',
			value: 25
		}],
		colors: ['rgb(0, 188, 212)', 'rgb(97, 97, 97)'],
		formatter: function (y) {
			return y + '%'
		}
	});
});


