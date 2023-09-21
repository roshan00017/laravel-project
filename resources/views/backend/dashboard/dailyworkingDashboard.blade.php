<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title {{setFont()}}" style="font-weight: bold;">{{$working_page_title}}</h3>
            </div>

            <div class="card-body p-0">
                @if(sizeof($dailyWorkingSchedule) > 0)
                    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead class="th-header">
                        <tr>
                            <th>{{ trans('message.commons.s_n') }}</th>
                            <th class="{{setFont()}}">{{ trans('schedule.title') }}</th>
                            <th class="{{setFont()}}">{{ trans('schedule.start_time') }}</th>
                            <th class="{{setFont()}}">{{ trans('schedule.end_time') }}</th>
                            <th class="{{setFont()}}">{{ trans('schedule.duration') }}</th>
                            <th class="{{setFont()}}">{{ trans('schedule.location') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dailyWorkingSchedule as $key => $schedule)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="{{setFont()}}">{{ isset($schedule['title']) ? $schedule['title'] : '' }}</td>
                                <td class="{{setFont()}}">{{ isset($schedule['start_time']) ? $schedule['start_time'] : '' }}</td>
                                <td class="{{setFont()}}">{{ isset($schedule['end_time']) ? $schedule['end_time'] : '' }}</td>
                                <td class="{{setFont()}}">{{ isset($schedule['duration']) ? $schedule['duration'] : '' }}</td>
                                <td class="{{setFont()}}">{{ isset($schedule['location']) ? $schedule['location'] : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer text-center">
                        <a href="{{ route('dailyschedules.index', ['today' => encrypt(\Carbon\Carbon::now()->toDateString())]) }}" class="{{setFont()}}">
                            <i class="fa fa-eye"></i> {{ trans('schedule.view_all') }}
                        </a>
                    </div>
                @else
                    <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
                        <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                            <i class="fas fa-ban" style="margin-top: 6px"></i>
                            {{trans('message.commons.no_karyatlika_found')}}
                        </label>
                    </div>
                @endif

            </div>

            

        </div>

    </div>
</div>
