<style>
table {
    table-layout: fixed;
    width: 100%;
}

td {
    word-break: break-word;
}
</style>
<div class="table-responsive">
<table class="table table-bordered">
    <thead style="margin-bottom:0px; ">
    {!! Form::open(['method'=>'get',
                'url'=>$page_url,
                'autocomplete'=>'off'])
           !!}
    <tr>
        <td style="border: none;"></td>
        <td colspan="2" style="border: none;padding-bottom: 0px;">
            <div class="form-group {{setFont()}}">

                {{Form::select('year_code',
                                $yearList->pluck('name','name'),
                                $year_code,
                                ['class'=>'form-control select2',
                                'style'=>'width: 100%',
                                'required',
                                'placeholder'=> trans('calendar.year').' '.trans('calendar.select')
                                ])
                 }}
            </div>
        </td>
        <td colspan="2" style="border: none;">
            <div class="form-group {{setFont()}}">
                {{Form::select('month_code',
                                $monthList->pluck('name','code'),
                                $month_code,
                                ['class'=>'form-control select2',
                                'style'=>'width: 100%',
                                'required',
                                'placeholder'=> trans('calendar.month').' '.trans('calendar.select')
                                ])
                 }}
            </div>
        </td>
        <td colspan="2" style="border: none;">
            <button style="padding:6px; border-radius:6px;"
                    type="submit"
                    id="btn-search"
                    name="click_btn"
                    value="filter"
                    class="btn btn-primary btn-xs {{setFont()}}"
            >
                <i class="fa fa-search"></i>
                {{trans('message.button.filter')}}
            </button>
        </td>
    </tr>
    {!! Form::close() !!}

    <tr>
        <td style="border: none;"></td>
        <td colspan="2" style="border: none;padding-top: 0px;">
            {!! Form::open(['method'=>'get',
                'url'=>$page_url,
                'autocomplete'=>'off'])
           !!}
            <input type="hidden" name="year_code" value="{{$year_code}}">
            <?php
$formattedMonthCodePrev = (int) $month_code;
$calcMonthCodePrev = $formattedMonthCodePrev > 1 ? $formattedMonthCodePrev - 1 : $formattedMonthCodePrev;
$monthCodePrev = $calcMonthCodePrev < 10 ? '0' . $calcMonthCodePrev : $calcMonthCodePrev;
?>
            <input type="hidden" name="month_code" value="{{$monthCodePrev}}">
            <button type="submit"
                    id="btn-search"
                    name="click_btn"
                    value="prev"
                    class="btn btn-primary btn-xs float-right"
                    title="{{trans('calendar.prev')}}"
            >
                <i class="fa fa-arrow-left"></i>
            </button>
            {!! Form::close() !!}
        </td>
        <td colspan="2" style="border: none;padding-top: 0px;">
            {!! Form::open(['method'=>'get',
                           'url'=>$page_url,
                           'autocomplete'=>'off'])
                      !!}
            <input type="hidden" name="year_code" value="{{$year_code}}">
            <?php
$formattedMonthCodeNext = (int) $month_code;
$calcMonthCodeNext = $formattedMonthCodeNext >= 1 ? $formattedMonthCodeNext + 1 : $formattedMonthCodeNext;
$monthCodeNext = $calcMonthCodeNext < 10 ? '0' . $calcMonthCodeNext : $calcMonthCodeNext;
?>
            <input type="hidden" name="month_code" value="{{$monthCodeNext}}">
            <button type="submit"
                    id="btn-search"
                    class="btn btn-primary btn-xs float-left"
                    name="click_btn"
                    value="next"
                    title="{{trans('calendar.next')}}"
            >
                <i class="fa fa-arrow-right"></i>
            </button>
            {!! Form::close() !!}

        </td>
        <td style="border: none;"></td>

    </tr>

    </thead>

    {{--    month name--}}
    <thead>
    <tr>
        <td colspan="7">
            <span class="{{setFont()}} text-danger"><strong>{{$year_code}} {{$month_name}}</strong></span>
            <span class="text-danger"><strong> | {{$year_month_en['first_month_en']}}/
                    {{$year_month_en['last_month_en']}} {{$year_month_en['year_en']}}
                </strong></span>
        </td>
    </tr>
    </thead>
    {{--    ======--}}
    <thead>
    <tr class="{{setFont()}} calendarHead">
        @if(count($weekDays) > 0)
            @foreach($weekDays as $weekDay)
                @if($weekDay->code=='07')
                    <td class="text-danger">{{$weekDay->name}}</td>
                @else
                    <td>{{$weekDay->name}}</td>
                @endif

            @endforeach
        @endif
    </tr>
    </thead>
    <tbody id="calendarTable">
    @if($monthFirstDay->week_day_code=='01')
        <tr>
            @for($i=0;$i<7;$i++)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($i==6)
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')
                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>

                    </td>
                @else

                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>


                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"

                    >

                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @endif
            @endfor
        </tr>
    @endif

    @if($monthFirstDay->week_day_code=='02')
        <tr>
            <td></td>
            @for($i=0;$i<6;$i++)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($i==5)
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @else
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"

                    >
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span><br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>

                    </td>
                @endif
            @endfor
        </tr>
    @endif

    @if($monthFirstDay->week_day_code=='03')
        <tr>
            <td></td>
            <td></td>
            @for($i=0;$i<5;$i++)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($i==4)
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>

                    <td class="text-danger {{setFont()}}" data-toggle="modal"
                        data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @else

                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"

                    >

                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @endif
            @endfor
        </tr>
    @endif

    @if($monthFirstDay->week_day_code=='04')
        <tr>
            <td></td>
            <td></td>
            <td></td>
            @for($i=0;$i<4;$i++)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($i==3)
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span><br/>
                        @include('backend.components.calendar.detail')
                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @else

                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"
                    >

                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span><br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @endif
            @endfor
        </tr>
    @endif

    @if($monthFirstDay->week_day_code=='05')
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @for($i=0;$i<3;$i++)

                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($i==2)
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>

                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @else
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"
                    >

                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @endif
            @endfor
        </tr>
    @endif

    @if($monthFirstDay->week_day_code=='06')
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @for($i=0;$i<2;$i++)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($i==1)
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>

                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span><br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @else
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"
                    >
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span> <br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @endif
            @endfor
        </tr>
    @endif

    @if($monthFirstDay->week_day_code=='07')
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            @for($i=0;$i<1;$i++)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($monthFirstDay->week_day_code=='07')
                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>
                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$dayCount}}">
                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span><br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @else

                    <?php
$dayCount = $monthFirstDay->day + $i;
$year = $monthFirstDay->fy_code;
$month = $monthFirstDay->month_code;
$day = $dayCount
?>


                    <td
                            data-toggle="modal" data-target="#calendarModal{{$dayCount}}"
                    >


                        <span class="{{setFont()}}">{{$monthFirstDay->day+$i}}</span><br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $monthFirstDay->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]+$i:''}}</small>
                    </td>
                @endif

            @endfor
        </tr>
    @endif
    @foreach($monthDays as $monthDayChunk)
        <tr>
            @foreach($monthDayChunk as $item)
                <?php
$meetingDays = $calRepo
    ->getMeetingDay(
        $monthFirstDay->fy_code,
        $monthFirstDay->month_code,
        $monthFirstDay->day + $i
    );
?>
                @if($item->week_day_code=='07')
                    <td class="text-danger" data-toggle="modal" data-target="#calendarModal{{$item->day}}">
                        <span class="{{setFont()}}">{{$item->day}}</span><br/>
                        <?php
$dayCount = $item->day;
$year = $item->fy_code;
$month = $item->month_code;
$day = $item->day
?>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $item->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]:''}}</small>
                    </td>
                @else

                    <?php
$dayCount = $item->day;
$year = $item->fy_code;
$month = $item->month_code;
$day = $item->day
?>


                    <td
                            data-toggle="modal" data-target="#calendarModal{{$item->day}}"

                    >
                        <span class="{{setFont()}}">{{$item->day}}</span><br/>
                        @include('backend.components.calendar.detail')

                        <?php
$dateEnArr = explode('-', $item->full_date_en);
?>
                        <small class="float-right">{{count($dateEnArr) > 0 ? $dateEnArr[2]:''}}</small>
                    </td>
                @endif
            @endforeach
        </tr>

    @endforeach

    </tbody>
</table>
</div>
