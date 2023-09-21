<style>
    #container {
        height: 400px;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>

<hr>
<div class="row">
    <div class="col-lg-4 col-xs-6">
        <div  class="small-box bg-danger {{setFont()}}">
            <div class="inner">
                <h3>{{$total_complaints}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_complaint') }}</h5>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
            <a href="{{url('complaints')}}" class="small-box-footer">{{trans('common.more_info')}} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div  class="small-box bg-info {{setFont()}}">
            <div class="inner">
                <h3>{{$total_today_complaint}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_today_complaint') }}</h5>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div style="background-color:darkslategray; color:white" class="small-box {{setFont()}}">
            <div class="inner">
                <h3>{{$total_suggestion}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_suggestion') }}</h5>
            </div>
            <div class="icon">
                <i class="fas fa-comment-dots"></i>
            </div>
            <a href="{{url('suggestions')}}" class="small-box-footer">{{trans('common.more_info')}} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <div  class="small-box bg-secondary {{setFont()}}">
            <div class="inner">
                <h3>{{$total_today_suggestion}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.today_total_suggestion') }}</h5>
            </div>
            <div class="icon">
                <i class="fas fa-comment-dots"></i>
            </div>
            <a
                    href="{{ route('suggestion',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-primary {{setFont()}}">
            <div class="inner">
                <h3>{{$total_incident}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_incident') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-calendar"></i>
            </div>
            <a href="{{url('incidentReporting')}}" class="small-box-footer">{{trans('common.more_info')}} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div  class="small-box bg-pink {{setFont()}}">
            <div class="inner">
                <h3>{{$total_today_incident}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.today_total_incident') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-calendar"></i>
            </div>
            <a
                    href="{{ route('incidentReporting',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">{{trans('common.more_info')}} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div id="complaint"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div id="suggestion"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div id="incident"></div>
        </div>
    </div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
            align: 'center'
        },
        xAxis: {
            categories: [
                @for($i=1; $i<=12; $i++)
                    '{{$monthNames[$i]}}',
                @endfor
            ]
        },
        credits: {
            enabled: false
        },
        yAxis: {
            min: 0,
            title: {
                text: "{{trans('dashboard.chart.total_complain_count')}}"
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
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total_number') }}: {point.stackTotal}'
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
            align: 'center'
        },
        colors: ['#1d800e', '#9e0d0d'],
        xAxis: {
            categories: [
                @for($i=1; $i<=12; $i++)
                    '{{$monthNames[$i]}}',
                @endfor
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: "{{trans('dashboard.chart.suggestion_count')}}"
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
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total_number') }}: {point.stackTotal}'
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
            align: 'center'
        },
        colors: ['#5DADE2', '#9e0d0d', '#1d800e'],
        xAxis: {
            categories: [
                @for($i=1; $i<=12; $i++)
                    '{{$monthNames[$i]}}',
                @endfor
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: "{{ trans('dashboard.chart.incident_count') }}"
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
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}'
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

<hr style="width: 100%">

<h4 class="{{setFont()}}">{{ trans('dashboard.msgdashboard.source') }}</h4>
<br>


<div class="row">
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-blue {{setFont()}}">
            <div class="inner">
                <h3>{{$total_facebook}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_facebook') }}</h5>
            </div>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(4)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div style="background-color:orange; color:white" class="small-box bg-y {{setFont()}}">
            <div class="inner">
                <h3>{{$total_sms}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_sms') }}</h5>
            </div>
            <div class="icon">
                <i class="fas fa-sms"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(2)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-lightblue {{setFont()}}">
            <div class="inner">
                <h3>{{$total_skype}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_skype') }}</h5>
            </div>
            <div class="icon">
                <i class="fab fa-skype"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(1)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


</div>

<div class="row">

    <div class="col-lg-4 col-xs-6">
        <div style="background-color:crimson" class="small-box bg-green {{setFont()}}">
            <div class="inner">
                <h3>{{$total_national}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_national') }}</h5>
            </div>
            <div class="icon">
                <i class="fas fa-phone"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(5)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div style="background-color:cadetblue" class="small-box bg-info {{setFont()}}">
            <div class="inner">
                <h3>{{$total_twitter}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_twitter') }}</h5>
            </div>
            <div class="icon">
                <i class="fab fa-twitter"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(3)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-danger {{setFont()}}">
            <div class="inner">
                <h3>{{$total_international}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_international') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-phone"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(6)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <div style="background-color:lightslategrey" class="small-box bg-secondary {{setFont()}}">
            <div class="inner">
                <h3>{{$total_website}}</h3>
                <h5> {{ trans('dashboard.grevience_dashboard.total_website') }}</h5>
            </div>
            <div class="icon">
                <i class="fab fa-edge"></i>
            </div>
            <a
                    href="{{ route('complaints.index',['source'=>encrypt(7)]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="complaintBySource">

        </div>
    </div>
</div>

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
            align: 'center'
        },
        xAxis: {
            categories: [
                @for($i=1; $i<=12; $i++)
                    '{{$monthNames[$i]}}',
                @endfor
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: "{{ trans('dashboard.chart.total_complain_count') }}"
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
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}'
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