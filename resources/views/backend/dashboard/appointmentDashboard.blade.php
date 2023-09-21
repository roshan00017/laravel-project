<style>
    #appointment_info {
        height: 500px;
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
    <div class="col-lg-3 col-xs-3">
        <div class="small-box bg-danger  {{ setFont() }}">
            <div class="inner">
                <h3>{{$total_appointment}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.appointment') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-handshake"></i>
            </div>
            <a href="{{ url('appointments') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-3">
        <div class="small-box  bg-purple  {{ setFont() }}">
            <div class="inner">
                <h3>{{$today_appointment}}</h3>
                <h5> {{ trans('dashboard.msgdashboard.today_req_appointment') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-handshake"></i>
            </div>
            <a
                    href="{{ route('appointments.index',['today'=>\Carbon\Carbon::now()->toDateString()]) }}"
                    class="small-box-footer">{{ trans('common.more_info') }}
                <i
                        class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-3">
        <div class="small-box  bg-green  {{ setFont() }}">
            <div class="inner">
                <h3>{{$total_schedule}}</h3>
                <h5> {{ trans('dashboard.totalSchedule') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-calendar"></i>
            </div>
            <a href="{{ url('dailyschedules') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-3">
        <div class="small-box  bg-primary  {{ setFont() }}">
            <div class="inner">
                <h3>{{$today_schedule}}</h3>
                <h5> {{ trans('dashboard.todaySchedule') }}</h5>
            </div>
            <div class="icon">
                <i class="far fa-calendar"></i>
            </div>
            <a
                    href="{{ route('dailyschedules.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{ trans('common.more_info') }}
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="info-box">
            @include('backend.components.calendar.calendar')
        </div>
    </div>
    <div class="col-md-6" style="height: 50%;">
        <div id="appointment_info">

        </div>
        <br>
        @include('backend.dashboard.dailyworkingDashboard')
    </div>
</div>


<script src="{{asset('plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/accessibility.js')}}"></script>

<script>
    Highcharts.chart('appointment_info', {
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
