<script src="{{asset('plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/accessibility.js')}}"></script>

<script>
    Highcharts.chart('service_token', {
        chart: {
            type: 'line',
            style: {
                fontFamily: 'Kalimati',
            }
        },
        title: {
            text: "{{ trans('frontendSuggestion.service_token.token_details') }}",
            align: 'center',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        colors: ['#FFFF00','#FF0000', '#00FF00'],
        xAxis: {
            categories: [
                @for($i=1; $i<=12; $i++)
                    '{{$monthNames[$i]}}',
                @endfor
            ],

            labels: {
                style: {
                    fontFamily: 'Kalimati',
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: "{{ trans('dashboard.chart.token_count') }}",
                style: {
                    fontFamily: 'Kalimati',
                }
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'gray',
                    textOutline: 'none'
                }
            },
            labels: {
                style: {
                    fontFamily: 'Kalimati',
                }
            }
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ['viewFullscreen', 'printChart', 'downloadPNG', 'downloadJPEG', 'downloadPDF','downloadCSV'],
                },
            },
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    fontFamily: 'Kalimati',
                }
            }
        },
        <?php echo @$tokenJsSeriesData; ?>
    });
</script>