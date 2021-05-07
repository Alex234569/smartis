let title = {
    text: 'Monthly Average Temperature'
};


let subtitle = {
    text: 'Source: WorldClimate.com'
};


var xAxis = {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'
        ,'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
};

var yAxis = {
    title: {
        text: 'Temperature (\xB0C)'
    },
    plotLines: [{
        value: 0,
        width: 1,
        color: '#808080'
    }]
};

var legend = {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle',
    borderWidth: 0
};

var json = {};

json.title = title;
json.subtitle = subtitle;
json.xAxis = xAxis;
json.yAxis = yAxis;
json.tooltip = tooltip;
json.legend = legend;
json.series = series;


$('#graph').highcharts(json);