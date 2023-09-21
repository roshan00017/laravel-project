<div class=" memberList">
    <table class="table table-bordered dynamicAddRemoveMembers">
        <tr>
            <th colspan=7 class="{{ setFont() }}">
                {{ trans('meeting.meeting.add_new_member') }}
            </th>
        </tr>
        <tr class="{{ setFont() }}">
            <th>
                {{ trans('message.pages.common.name_en') }}
            </th>
            <th>
                {{ trans('message.pages.common.name_np') }}
            </th>
            <th>
                {{ trans('message.pages.meeting_member.office') }}
            </th>
            <th>
                {{ trans('message.pages.common.designation') }}
            </th>
            <th>
                {{ trans('message.pages.meeting_member.contact_no') }}
            </th>
            <th>
                {{ trans('message.pages.meeting_member.email') }}
            </th>
            <th>
                {{ trans('message.pages.meeting_member.is_invite') }}
            </th>
            <th>
                {{ trans('message.commons.action') }}
            </th>
        </tr>
        <tr>
            <td>
                <input type="text" name="addMeetingMembers[0][name_en]" class="form-control" autocomplete="off"/>
            </td>

            <td>
                <input type="text" name="addMeetingMembers[0][name_np]" class="form-control" autocomplete="off" />
            </td>

            <td>
                <input type="text" name="addMeetingMembers[0][office]" class="form-control" autocomplete="off" />
            </td>
            <td>
                <input type="text" name="addMeetingMembers[0][post]" class="form-control" autocomplete="off" />
            </td>

            <td>
                <input type="text"  name="addMeetingMembers[0][contact_no]" class="form-control mobileNo"
                    autocomplete="off" />
            </td>
            <td>
                <input type="email" name="addMeetingMembers[0][email]" class="form-control" autocomplete="off" />
            </td>

            <td class="{{ setFont() }}">
                <input class="radio-button" name="addMeetingMembers[0][is_invite]" type="radio" checked value="1"
                    style="margin-top: 2px">
                {{ trans('message.button.yes') }}
                <br>
                <input class="radio-button" name="addMeetingMembers[0][is_invite]" type="radio" value="0"
                    style="margin-top: 2px">
                {{ trans('message.button.no') }}
            </td>
            <td>
                <button type="button" name="add"
                    class="btn btn-sm btn-success rounded-pill dynamic-arMembers {{ setFont() }}">
                    {{ trans('meeting.meeting.add') }}
                </button>
            </td>
        </tr>
    </table>


</div>
<script>
    const addText = "{{ trans('meeting.meeting.add') }}";
    const removeText = "{{ trans('schedule.remove') }}";
    const yes = "{{ trans('schedule.yes') }}";
    const no = "{{ trans('schedule.no') }}";
</script>
