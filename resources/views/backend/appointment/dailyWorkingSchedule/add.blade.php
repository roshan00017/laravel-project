<div class="form-group col-md-12">
    <table class="table table-bordered dynamicAddRemove">
        <tr>
            <th colspan="4" class="{{ setFont() }}">
                {{ trans('schedule.details') }}
            </th>
        </tr>
        <tr class="{{ setFont() }}">
            <th>
                {{ trans('schedule.title') }}
            </th>
            <th>
                {{ trans('schedule.start_time') }}
            </th>
            <th>
                {{ trans('schedule.end_time') }}
            </th>

            {{-- <th>
                {{ trans('schedule.is_completed_sameday') }}
            </th> --}}
            <th>
                {{ trans('schedule.location') }}
            </th>
            <th>
                {{ trans('message.commons.action') }}
            </th>
        </tr>
        <tr>
            <td width="30%">
                <input type="text" required name="dailySchedule[0][title]" class="form-control" autocomplete="off" />
            </td>
            <td width="10%">
                <input type="time" required name="dailySchedule[0][start_time]" class="form-control" autocomplete="off" />
            </td>
            <td width="10%">
                <input type="time" required name="dailySchedule[0][end_time]" class="form-control" autocomplete="off" />
            </td>
            
            {{-- <td width="10%">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dailySchedule[0][is_completed_sameday]" value="1" required checked>
                    <label class="form-check-label" for="completed_yes">
                        {{ trans('schedule.yes') }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="dailySchedule[0][is_completed_sameday]" value="0" required>
                    <label class="form-check-label" for="completed_no">
                        {{ trans('schedule.no') }}
                    </label>
                </div>
                <div id="end_time_field">
                    <label for="end_time">{{ trans('schedule.end_time') }}</label>
                    <input type="time" required name="dailySchedule[0][end_time]" class="form-control" autocomplete="off" />
                </div>
                <div id="schedule_end_date_fields" style="display: none;">
                    <div class="form-group col-md-6 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('schedule.schedule_end_date_en') }}
                        </label>
                        {!! Form::text('schedule_end_date_en', null, [
                            'class' => 'form-control englishDatePicker',
                            'placeholder' => trans('schedule_end_date_en') ,
                            'autocomplete' => 'off',
                            'id' => 'date_from_en',
                            'required' => 'required', // Added 'required' attribute
                        ]) !!}
                        @if ($errors->has('schedule_end_date_en'))
                            <small class="text text-danger">{{ $errors->first('schedule_end_date_en') }}</small>
                        @endif
                    </div>
                </div>
            </td> --}}
            <td width="20%">
                <input type="text" required name="dailySchedule[0][location]" class="form-control" autocomplete="off" />
            </td>
            <td width="15%">
                <button type="button" class="btn btn-sm btn-success rounded-pill addRow {{ setFont() }}">
                    {{ trans('meeting.meeting.add') }}
                </button>
            </td>
        </tr>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[name="dailySchedule[0][is_completed_sameday]"]').change(function() {
            if ($(this).val() === '0') {
                $('#schedule_end_date_fields').show();
                $('#end_time_field').show();
            } else {
                $('#schedule_end_date_fields').hide();
                $('#end_time_field').show();
            }
        });

        // Show the corresponding fields based on the initial value
        if ($('input[name="dailySchedule[0][is_completed_sameday]"]:checked').val() === '0') {
            $('#schedule_end_date_fields').show();
            $('#end_time_field').hide();
        } else {
            $('#schedule_end_date_fields').hide();
            $('#end_time_field').show();
        }
    });

    
</script>

{{-- Small JS field for show and add --}}
<script>
    const addText = "{{ trans('meeting.meeting.add') }}";
    const removeText = "{{ trans('schedule.remove') }}";
</script>
