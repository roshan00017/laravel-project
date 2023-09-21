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


<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div style="background-color:orange; color:white" class="small-box {{setFont()}}">
            <div class="inner">
                <h3>{{$total_dispatch}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.total_dispatch') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-envelope"></i>
            </div>
            <a href="{{ url('dcDispatchBook') }}" class="small-box-footer">{{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div  class="small-box bg-info {{ setFont() }}">
            <div class="inner">
                <h3>{{$today_dispatch}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.today_dispatch') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-envelope"></i>
            </div>
            <a
                    href="{{ route('dcDispatchBook.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- total meeting count block end --}}

    <div class="col-lg-3 col-xs-6">
        <div  class="small-box bg-green {{ setFont() }}">
            <div class="inner">
                <h3>{{$total_register}}</h3>
                <h5>{{ trans('dashboard.msgdashboard.total_register') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-address-book"></i>
            </div>
            <a href="{{ url('dcRegisterBook') }}" class="small-box-footer">{{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div  class="small-box bg-blue {{setFont()}}">
            <div class="inner">
                <h3>{{$today_register}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.today_register') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-address-book"></i>
            </div>
            <a
                    href="{{ route('dcRegisterBook.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-primary {{setFont()}}">
            <div class="inner">
                <h3>{{$total_document}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.total_document') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a href="{{ url('dcDocument') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box  bg-secondary {{ setFont() }}">
            <div class="inner">
                <h3>{{$total_document}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.today_document') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-file"></i>
            </div>
            <a
                    href="{{ route('dcDocument.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">{{ trans('common.more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div  class="small-box bg-danger  {{ setFont() }}">
            <div class="inner">
                <h3>{{$total_appointment}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.appointment') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-handshake"></i>
            </div>
            <a
                    href="{{ url('appointments') }}"
                    class="small-box-footer">
                {{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="small-box  bg-purple  {{ setFont() }}">
            <div class="inner">
                <h3>{{$today_appointment}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.today_appointment') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-handshake"></i>
            </div>
            <a
                    href="{{ route('appointments.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Chart View  -->

<div class="row">
    <div class="@if(userInfo()->user_module !='edmis') col-md-6 @else col-md-12 @endif">
        <div class="card">

            <div id="dispatch">

            </div>

        </div>
    </div>

    <div class="@if(userInfo()->user_module !='edmis') col-md-6 @else col-md-12 @endif">
        <div class="card">
            <div id="register">

            </div>
        </div>
    </div>
    <div class="@if(userInfo()->user_module !='edmis') col-md-6 @else col-md-12 @endif">
        <div class="card">
            <div id="appointment">

            </div>
        </div>
    </div>
</div>

<script src="{{asset('plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/accessibility.js')}}"></script>

<!-- Dispatch BooK Chart -->
<script>
    Highcharts.chart('dispatch', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        title: {
            text: "{{ trans('dashboard.chart.status_wise_dc_dispatch_book_title') }}",
            align: 'center',
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
                text: "{{ trans('dashboard.chart.total_dispatch_book') }}"
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
        credits: {
            enabled: false
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 30,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}'

        },
        exporting: {
            buttons: {
                menuItems: ["viewFullscreen", "printChart", "downloadPNG", "downloadJPEG", "downloadPDF",
                    "downloadCSV"
                ]
            },
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        <?php echo @$dispatchBookJsSeriesData; ?>

    });
</script>


<!-- Register Book Charts -->
<script>
    Highcharts.chart('register', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        title: {
            text: "{{ trans('dashboard.chart.status_wise_dc_regd_book_title') }}",
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
                text: "{{ trans('dashboard.chart.total_register_book') }}"
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
        credits: {
            enabled: false
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 30,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}'
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ["viewFullscreen", "printChart", "downloadPNG", "downloadJPEG", "downloadPDF",
                        "downloadCSV"
                    ]
                },
            },
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        <?php echo @$registerBookJsSeriesData; ?>
    });
</script>

<script>
    Highcharts.chart('appointment', {
        chart: {
            type: 'column',
            style: {
                    fontFamily: 'Kalimati',
                }
        },
        title: {
            text: "{{ trans('dashboard.chart.appointment_status_wise_detail') }}",
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
                text: "{{ trans('dashboard.chart.total_appointment') }}"
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
        credits: {
            enabled: false
        },
        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 30,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>{{ trans('dashboard.chart.total') }}: {point.stackTotal}'
        },
        exporting: {
            buttons: {
                contextButton: {
                    menuItems: ["viewFullscreen", "printChart", "downloadPNG", "downloadJPEG", "downloadPDF",
                        "downloadCSV"
                    ]
                },
            },
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        <?php echo @$appointmentJsSeriesData; ?>
    });
</script>

