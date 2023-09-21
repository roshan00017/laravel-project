<script src="{{asset('plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/accessibility.js')}}"></script>
<script>
    Highcharts.chart('meeting', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        title: {
            text: "{{ trans('dashboard.chart.meeting_status_title') }}",
            align: 'center',
            style:{
                fontFamily: "Kalimati",
            }
        },
        colors: ['yellow', 'red', 'blue', 'black', 'green'],
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
                text: "{{ trans('dashboard.chart.meeting_count') }}",
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
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total_number') }}: {point.stackTotal}',
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
                    enabled: true
                }
            }
        },
        <?php echo $meetingJsSeriesData; ?>
    });
</script>