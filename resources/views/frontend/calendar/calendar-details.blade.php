<div
        class="modal fade"
        id="calendarModal{{ @$dayCount }}"
        aria-hidden="true"
        data-keyboard="false"
        data-backdrop="static"
>
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
                <br/>
                <span>
                    {{ $calRepo->nepaliDateFormatter(@$year, @$month, @$day)['date_en'] }}
                </span>
                <br/>
                <br/>
                <form action="{{ route('appointment-info') }}" method="GET">
                    @php
                        $fullDate = $year . '-' . $month . '-' . $day
                    @endphp
                    <input type="hidden" name="date" value="{{ encrypt($fullDate) }}">
                    <button type="submit" class="btn btn-primary btn-sm float-right  rounded-pill {{ setFont() }}"
                            title="{{ trans('dashboard.appointment') }}">
                        <i class="fa fa-plus-circle"></i>
                        {{ trans('dashboard.appointment') }}
                    </button>
                </form>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
