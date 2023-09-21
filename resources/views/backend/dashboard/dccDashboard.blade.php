<hr>
<!-- close style -->
<h4 class="{{setFont()}}">
    {{ trans('dashboard.dcs') }}
</h4>
<br>
<div class="row">

    {{--total meeting count block start --}}
    <div class="col-lg-4 col-xs-6">
        <div style="background-color:#1a5ceb; color:white" class="small-box bg-primary {{setFont()}}">
            <div class="inner">
                <h3>{{$totalService}}</h3>
                <h5> {{ trans('dashboard.dccdashboard.total_service') }}</h5>
            </div>
            <div class="icon">
                <i class="fa fa-tasks"></i>
            </div>
            <a href="{{url('services')}}" class="small-box-footer">{{trans('common.more_info')}} <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-xs-6">
        <div style="background-color:orange; color:white" class="small-box {{setFont()}}">
            <div class="inner">
                <h3>
                    {{$totalToken}}
                </h3>
                <h5>
                    {{ trans('dashboard.dccdashboard.total_token_service') }}
                </h5>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{url('serviceTokenList')}}"
               class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right">

                </i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <div class="small-box bg-secondary {{setFont()}}">
            <div class="inner">
                <h3>
                    {{$totalToken}}
                </h3>
                <h5>
                    {{ trans('dashboard.todayServiceTokenList') }}
                </h5>
            </div>
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
            <a
                    href="{{ route('serviceTokenList.index',['today'=>encrypt(\Carbon\Carbon::now()->toDateString())]) }}"
                    class="small-box-footer">
                {{trans('common.more_info')}}
                <i class="fas fa-arrow-circle-right">

                </i>
            </a>
        </div>
    </div>
</div>
{{--total meeting count block end --}}


<div class="wrapper">
    <div class="row">
        <div class="col-md-8">
            <div class="card ">
                <div id="serviceToken">

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title {{setFont()}}">
                        <strong>{{trans('frontendSuggestion.service_token.token_details')}}</strong>
                    </h3>
                </div>

                <div class="progress-group {{setFont()}}">
                    <span style="margin-left: 8px" class="progress-text ">
                        {{trans('frontendSuggestion.service_token.start_token')}}
                    </span>
                    <span style="margin-right: 8px" class="float-right">
                        {{$startToken}}<b>/{{$totalToken}}</b><i style="margin-left:9px">{{$spercent}}%</i>
                    </span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{$spercent}}%"></div>
                    </div>
                </div>

                <div class="progress-group {{setFont()}}">
                    <span style="margin-left: 8px" class="progress-text ">
                        {{trans('frontendSuggestion.service_token.cancelled_token')}}
                    </span>
                    <span style="margin-right: 8px" class="float-right">{{$cancelToken}}<b>/{{$totalToken}}</b><i
                                style="margin-left:9px">{{$cancelpercent}}%</i></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width:{{$cancelpercent}}%"></div>
                    </div>
                </div>

                <div class="progress-group {{setFont()}}">
                    <span style="margin-left: 8px" class="progress-text ">
                        {{trans('frontendSuggestion.service_token.complete_token')}}
                    </span>
                    <span style="margin-right: 8px" class="float-right">{{$completeToken}}<b>/{{$totalToken}}</b><i
                                style="margin-left:9px">{{$completepercent}}%</i></span>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width:{{$completepercent}}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/exporting.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/export-data.js')}}"></script>
<script src="{{asset('plugins/highcharts/js/accessibility.js')}}"></script>
<script>
    Highcharts.chart('serviceToken', {
        chart: {
            type: 'column',
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
            text: "{{ trans('dashboard.chart.title3') }}",
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
                text: "{{ trans('dashboard.chart.token_count') }}"
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
        <?php echo @$tokenServiceJsSeriesData; ?>
    });
</script>