<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div style="background-color:#1a5ceb; color:white" class="small-box bg-primary {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $total_meeting }}</h3>
                        <h5> {{ trans('meetingDashboard.total_meeting') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ url('/meetings') }}" class="small-box-footer">{{ trans('common.more_info') }} <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div style="background-color:orange; color:white" class="small-box {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $total_pending_meeting }}</h3>
                        <h5> {{ trans('meetingDashboard.total_pending') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-hourglass"></i>
                    </div>
                    <a
                            href="{{ route('meetings.index',['status'=>encrypt(1)]) }}"
                            class="small-box-footer">
                        {{ trans('common.more_info') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- total meeting count block end --}}

            <div class="col-lg-3 col-xs-6">
                <div style="background-color:brown; color:white" class="small-box bg-info {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $total_preponed_meeting }}</h3>
                        <h5> {{ trans('meetingDashboard.total_preponed') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-calendar-clock"></i>
                    </div>
                    <a
                            href="{{ route('meetings.index',['status'=>encrypt(2)]) }}"
                            class="small-box-footer">
                        {{ trans('common.more_info') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-pink {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $total_postponed_meeting }}</h3>
                        <h5> {{ trans('meetingDashboard.total_postponed') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock"></i>
                    </div>
                    <a
                            href="{{ route('meetings.index',['status'=>encrypt(3)]) }}"
                            class="small-box-footer">
                        {{ trans('common.more_info') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div style="background-color:red; color:white" class="small-box bg-danger {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $total_canceled_meeting }}</h3>
                        <h5> {{ trans('meetingDashboard.total_cancel') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ban"></i>
                    </div>
                    <a
                            href="{{ route('meetings.index',['status'=>encrypt(4)]) }}"
                            class="small-box-footer">
                        {{ trans('common.more_info') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div style="background-color:green; color:white" class="small-box bg-green {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $total_execute_meeting }}</h3>
                        <h5> {{ trans('meetingDashboard.total_execute') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <a
                            href="{{ route('meetings.index',['status'=>encrypt(5)]) }}"
                            class="small-box-footer">
                        {{ trans('common.more_info') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div style="background-color:green; color:white" class="small-box bg-gray   {{ setFont() }}">
                    <div class="inner">
                        <h3>{{ $today_meetings }}</h3>
                        <h5> {{ trans('meetingDashboard.todays_scheduled_meeting') }}</h5>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar-day"></i>
                    </div>
                    <a
                            href="{{ route('meetings.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                            class="small-box-footer">
                        {{ trans('common.more_info') }}
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@if( userInfo()->user_module !='mms')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div id="meeting">

                    </div>

                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endif

@if( userInfo()->user_module =='mms')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box">
                        @include('backend.components.calendar.calendar')
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div id="meeting">

                    </div>

                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endif
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
            align: 'center'
        },
        colors: ['yellow', 'red', 'blue', 'black', 'green'],
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
                text: "{{ trans('dashboard.chart.meeting_count') }}"
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
        <?php echo @$meetingJsSeriesData; ?>
    });
</script>