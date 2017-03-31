$(document).ready(function() {
    var host = $('.data').data('host');
    var port = $('.data').data('port');
    var link = (port == '') ? host : host + ":" + port;
    var socket = io.connect(link);

    function paintChart() {
        var number = parseInt($('.ct-data').attr('data-number'));
        var charts = $('.ct-data').attr('data-content');

        if (charts) {

            var obj = jQuery.parseJSON( charts );

            for (i = 0; i < obj.length; i++) {
                var dataInput = new Array();

                for (j = 0; j < obj[i]['chart'].length; j++) {
                    dataInput.push([obj[i]['chart'][j]['answer'], obj[i]['chart'][j]['percent']]);
                }

                var count = i + 1;

                if(dataInput.length != 1) {
                    Highcharts.chart('container' + i, {
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            },
                            style: {
                                fontFamily: 'Arial'
                            },
                            spacingBottom: 15,
                            spacingTop: 70,
                            spacingLeft: 70,
                            spacingRight: 70,
                        },
                        title: {
                            text: count + '.' + obj[i]['question']['content'],
                            floating: true,
                            align: 'left',

                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                depth: 35,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Browser share',
                            data: dataInput
                        }]
                    });
                }
            }
        }
    }

    $(function() {
        paintChart();
    });

    socket.on('answer', function (data) {
        var socketData = $.parseJSON(data);

        if (socketData.success) {
            $('#home').html(socketData.viewChart);
            $('#menu1').html(socketData.viewDetailResult);
            $('#menu3').html(socketData.viewUserAnswer);
            $('.tab-pane-chart').html(socketData.viewChart);
            $('.tab-pane-detail-result').html(socketData.viewDetailResult);
            $('.tab-pane-users-answer').html(socketData.viewUserAnswer);
            paintChart();
        }
    });
});
