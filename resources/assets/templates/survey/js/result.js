$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    
    if ($('.scroll-answer-result').height() >= 250) {
        $('.scroll-answer-result').css({
            'overflow-y': 'scroll',
            'max-height': '250px',
        });
    }

    $('.zoom-btn-result').on('click', function(event) {
        event.preventDefault();
        var contentSection = $(this).closest('.wrapper-section-result').next('.content-section-result');

        if ($(contentSection).is(":visible")) {
            $(contentSection).hide('slide', { direction: 'up', }, 600);
            $(this).removeClass('zoom-in-btn');
            $(this).addClass('zoom-out-btn');
            $(this).closest('.wrapper-section-result').css('border-bottom', '1px solid #1987ad');
        } else {
            $(contentSection).show
            $(this).removeClass('zoom-out-btn');
            $(this).addClass('zoom-in-btn');
            $(this).closest('.wrapper-section-result').css('border-bottom', 'none');
        }

        return false;
    });

    $('.checkboxes-result').each(function(){
        var data = $.parseJSON($(this).attr('data'));
        var text = '';

        $.each(data, function(index, item) {
            var name = item['content'];

            if(name.length > 20) name = name.substring(0, 20) + '...';

            text += `{"name": "${name}", "y": ${item['percent']}}`;
            text += (index == data.length - 1) ? '' : ',';
        });

        text = '[' + text + ']';
        var dataCheckboxes = $.parseJSON(text);

        Highcharts.chart($(this).attr('id'), {
            chart: {
                type: 'bar',
                inverted: true,
            },
            exporting: {
                enabled: false,
            },
            title: {
                text: '',
            },
            subtitle: {
                text: '',
            },
            xAxis: {
                type: 'category',
            },
            yAxis: {
                title: {
                    text: '',
                }
            },
            legend: {
                enabled: false,
            },
            credits: {
                enabled: false,
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}%',
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>',
            },
            series: [
                {
                    name: '',
                    colorByPoint: true,
                    data: dataCheckboxes,
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500,
                    },
                    chartOptions: {
                        xAxis: {
                            labels: {
                                formatter: function () {
                                    return this.value.charAt(0);
                                }
                            }
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -2,
                            },
                            title: {
                                text: '',
                            }
                        }
                    }
                }]
            }
        });
    });

    $('.multiple-choice-result').each(function(){
        var data = $.parseJSON($(this).attr('data'));
        var text = '';

        $.each(data, function(index, item) {
            var name = item['content'];

            if(name.length > 50) name = name.substring(0, 50) + '...';

            text += `{"name": "${name}", "y": ${item['percent']}}`;
            text += (index == data.length - 1) ? '' : ',';
        });

        text = '[' + text + ']';
        var dataMultipleChoice = $.parseJSON(text);

        Highcharts.chart($(this).attr('id'), {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0,
                }
            },
            exporting: {
                enabled: false,
            },
            title: {
                text: '',
            },
            credits: {
                enabled: false,
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 40,
                    dataLabels: {
                        enabled: true,
                        format: '{point.percentage:.1f} %',
                        colors: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        distance: -50,
                    },
                    showInLegend: true,
                }
            },
            series: [
                {
                    type: 'pie',
                    name: '',
                    data: dataMultipleChoice,
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500,
                    },
                    chartOptions: {
                        xAxis: {
                            labels: {
                                formatter: function () {
                                    return this.value.charAt(0);
                                }
                            }
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -2,
                            },
                            title: {
                                text: '',
                            }
                        }
                    }
                }]
            }
        });
    });
});
