<?php


namespace app\views;


use app\models\currencyGetInfo\currencyModel;

class Graph
{
    public static function show(CurrencyModel $data, array $json): void
    {
        ?><div id="main">
            <div id="graph">
                <script language = "JavaScript">
                    var date = <?=$json['date']?>;
                    var value = <?=$json['value']?>;

                    $(document).ready(function() {
                        var title = {
                            text: 'Курс доллара'
                        };
                        var subtitle = {
                            text: 'Source: www.cbr.ru'
                        };
                        var xAxis = {
                            categories: date,
                        };
                        var yAxis = {
                            title: {
                                text: 'Руб.'
                            },
                            plotLines: [{
                                value: 10,
                                width: 100,
                                color: '#808080'
                            }]
                        };

                        var tooltip = {
                            valueSuffix: 'руб.'
                        }
                        var legend = {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle',
                            borderWidth: 0
                        };
                        var series =  [{
                            name: 'USD',
                            data: value
                        }];

                        var json = {};
                        json.title = title;
                        json.subtitle = subtitle;
                        json.xAxis = xAxis;
                        json.yAxis = yAxis;
                        json.tooltip = tooltip;
                        json.legend = legend;
                        json.series = series;
                        console.log(json);

                        $('#graph').highcharts(json);
                    });
                </script>
            </div>
        </div>
        <?php
    }
}