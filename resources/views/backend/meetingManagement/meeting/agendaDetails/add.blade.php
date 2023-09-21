<div class="form-group col-md-12">
    <table class="table table-bordered dynamicAddRemove">
        <tr>
            <th colspan="4" class="{{ setFont() }}">
                {{ trans('meeting.meeting.add_new_agenda') }}
            </th>
        </tr>


        <tr class="{{ setFont() }}">
            <th>
                {{ trans('meeting.meeting.agenda_title') }}
            </th>
            <th>
                {{ trans('meeting.meeting.description') }}
            </th>
            <th>
                {{ trans('message.commons.action') }}
            </th>
        </tr>
        <tr>
            <td width="40%">
                <input type="text" name="addMeetingAgendas[0][agenda_title]" class="form-control" autocomplete="off" />
            </td>

            <td width="40%">
                <textarea
                type="text"
                name="addMeetingAgendas[0][description]"
                class="form-control"
                autocomplete="off"
                rows="1"
            ></textarea>

            </td>
            <td >
                <button type="button" name="add" class="btn btn-sm btn-success rounded-pill dynamic-ar agendaList {{ setFont() }}">
                    {{ trans('meeting.meeting.add') }}
                </button>
            </td>
        </tr>
    </table>
</div>

{{-- Responsible for loading Js dynamically --}}
<script>
    const addText = "{{ trans('meeting.meeting.add') }}";
    const removeText = "{{ trans('schedule.remove') }}";
    const yes = "{{ trans('schedule.yes') }}";
    const no = "{{ trans('schedule.no') }}";
</script>