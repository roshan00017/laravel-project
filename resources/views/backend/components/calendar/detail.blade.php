<div class="modal fade" id="calendarModal{{ @$dayCount }}" aria-hidden="true" data-keyboard="false"
    data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('calendar.calendar') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close"> &times;
                    </span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left">

                <span class="{{ setFont() }}">
                    {{ $calRepo->nepaliDateFormatter(@$year, @$month, @$day)['date_np'] }}
                </span>
                <br />
                <span>
                    {{ $calRepo->nepaliDateFormatter(@$year, @$month, @$day)['date_en'] }}
                </span>
                <br />

                <?php
                $applyMeetingDays = $meetingDays;
                ?>

{{--                @if (count($applyMeetingDays) > 0)--}}
{{--                    @foreach ($applyMeetingDays as $meetingDay)--}}
{{--                        <br /><small class="text-info">{{ $meetingDay->title }}</small>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
                <br />
                <form action="{{ route('meetings.create') }}" method="GET">
                    <input type="hidden" name="date_np" value="{{ $year . '-' . $month . '-' . $day }}">

                    <input type="hidden" name="date_en" value="{{ $year . '-' . $month . '-' . $day }}">

                    @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='mms')
                        <button type="submit" class="btn btn-primary btn-sm float-left  rounded-pill {{ setFont() }}"
                                title="{{ trans('dashboard.meeting') }}">
                            <i class="fa fa-plus-circle"></i>
                            {{ trans('dashboard.meeting') }}
                        </button>
                    @endif
                </form>

                <form action="{{ route('dailyschedules.create') }}" method="GET">
                    <input type="hidden" name="date_np" value="{{ $year . '-' . $month . '-' . $day }}">

                    @if(  userInfo()->user_module =='app')
                        <button type="submit" class="btn btn-secondary btn-sm float-left  rounded-pill {{ setFont() }}"
                                title="{{ trans('dashboard.schedule') }}">
                            <i class="fa fa-plus-circle"></i>
                            {{ trans('dashboard.schedule') }}
                        </button>
                    @endif
                </form>
                <form action="{{ route('appointment.appointmentInfo') }}" method="GET">
                    <input type="hidden" name="date_np" value="{{ $year . '-' . $month . '-' . $day }}">

                    <input type="hidden" name="date_en" value="{{ $year . '-' . $month . '-' . $day }}">
                    @if(systemAdmin() == true || userInfo()->user_module =='client_admin' || userInfo()->user_module =='edmis' ||  userInfo()->user_module =='app')
                        <button type="submit" class="btn btn-primary btn-sm float-right  rounded-pill {{ setFont() }}"
                                title="{{ trans('dashboard.appointment') }}">
                            <i class="fa fa-plus-circle"></i>
                            {{ trans('dashboard.appointment') }}
                        </button>
                    @endif
                </form>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
