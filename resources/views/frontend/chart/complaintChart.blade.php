<script src="{{asset('plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/accessibility.js')}}"></script>
<script>
    Highcharts.chart('complaint', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        title: {
            text: "{{trans('dashboard.chart.status_wise_complaint_details')}}",
            align: 'center',
            style:{
                fontFamily: "Kalimati",
            }
        },
        colors: ['#FF0000', '#00FF00'],
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
        credits: {
            enabled: false
        },
        yAxis: {
            min: 0,
            title: {
                text: "{{trans('dashboard.chart.total_complain_count')}}",
                style: {
                    fontFamily: 'Kalimati',
                }
            },
            stackLabels: {
                enabled: true
            }
        },
        legend: {
            align: 'left',
            x: 70,
            verticalAlign: 'top',
            y: 70,
            floating: true,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ['viewFullscreen', 'printChart', 'downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadCSV'],
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
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        <?php echo @$complaintJsSeriesData; ?>
    });
</script>

<script>
    Highcharts.chart('complaintBySource', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        title: {
            text: "{{ trans('dashboard.chart.source_wise_complaint_title') }}",
            align: 'center',
            style:{
                fontFamily: "Kalimati",
            }
        },
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
                text: "{{ trans('dashboard.chart.total_complain_count') }}",
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
        legend: {
            align: 'center',
            x: 70,
            verticalAlign: 'top',
            y: 70,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ['viewFullscreen', 'printChart', 'downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadCSV'],
                },
            },
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}',
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
        <?php echo @$complaintSourceJsSeriesData; ?>
    });
</script>

<script>
    Highcharts.chart('suggestion', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        credits: {
            enabled: false
        },
        title: {
            text: "{{ trans('dashboard.chart.type_wise_suggestion_title') }}",
            align: 'center',
            style:{
                fontFamily: "Kalimati",
            }
        },
        colors: ['#1d800e', '#9e0d0d'],
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
                text: "{{trans('dashboard.chart.suggestion_count')}}",
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
                    menuItems: ['viewFullscreen', 'printChart', 'downloadPNG', 'downloadJPEG', 'downloadPDF', 'downloadCSV'],
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
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        <?php echo @$suggestionTypeJsSeriesData; ?>
    });
</script>

<script>
    Highcharts.chart('incident', {
        chart: {
            type: 'line',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        credits: {
            enabled: false
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ["viewFullscreen", "printChart", "downloadPNG", "downloadJPEG", "downloadPDF",
                        "downloadCSV"
                    ]
                }
            }
        },
        title: {
            text: "{{ trans('dashboard.chart.incident_details') }}",
            align: 'center',
            style:{
                fontFamily: "Kalimati",
            }
        },
        colors: ['#5DADE2', '#9e0d0d', '#1d800e'],
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
                text: "{{ trans('dashboard.chart.incident_count') }}",
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
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        <?php echo @$incidentJsSeriesData; ?>
    });
</script>