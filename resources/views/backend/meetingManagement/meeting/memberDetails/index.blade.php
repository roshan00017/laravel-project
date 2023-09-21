<div class="form-group col-md-12 ">
    <label class="{{setFont()}}">
        {{ trans('meeting.meeting.meeting_member') }}
    </label>
    <table id="example3" class="table table-bordered table-striped dataTable dtr-inline">
        @if(sizeof($memberList) > 0)

            <thead class="th-header">

            <tr class="{{setFont()}}">
                <th width="10px">
                    {{ trans('message.commons.s_n') }}
                </th>
                <th>
                    {{ trans('message.pages.common.name') }}
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
                    {{ trans('message.pages.meeting_member.is_invite') }}
                </th>
                <th>
                    {{ trans('message.commons.action') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($memberList as $key=>$member)
                <tr>
                    <th scope="row {{setFont()}}">
                        {{ ($memberList->currentpage()-1) * $memberList->perpage() + $key+1 }}
                    </th>
                    <td class="{{setFont()}}">

                        {{getLan() == 'np' ? $member->name_np : $member->name_en}}

                    </td>
                    <td class="{{setFont()}}">
                        @if(isset($member->office))
                            {{$member->office}}
                        @endif
                    </td>
                    <td class="{{setFont()}}">
                        @if(isset($member->post))
                            {{$member->post}}
                        @endif
                    </td>

                    <td class="{{setFont()}}">
                        @if(isset($member->contact_no))
                            {{$member->contact_no}}
                        @endif
                    </td>

                    <td class="{{setFont()}}">
                        @if($member->is_invite == true)
                            <button type="button"
                                    class="btn btn-success btn-xs rounded-pill {{setFont()}}"
                                    data-toggle="modal"
                                    data-target="#isActiveModal{{$key}}"
                                    title="{{trans('message.button.invite_update')}}"
                            >
                                {{trans('message.button.yes')}}
                            </button>
                        @elseif($member->is_invite== false)
                            <button type="button"
                                    class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                    data-toggle="modal"
                                    data-target="#isActiveModal{{$key}}"
                                    title="{{trans('message.button.invite_update')}}"
                            >
                                {{trans('message.button.no')}}
                            </button>
                        @endif
                    </td>
                    <td>

                        @if (allowEdit() && $value->agenda_finalized == 0 && $value->meeting_status_id
                                      == 1)
                            <button type="button" class="btn btn-info btn-xs rounded-pill {{ setFont() }}"
                                    data-toggle="modal"
                                    data-target="#editMember{{ $key }}" data-placement="top"
                                    title="{{ trans('message.button.edit') }}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        @endif
                        &nbsp;
                        @if(allowDelete()&& $value->agenda_finalized == 0 && $value->meeting_status_id
                                      == 1)
                            <button type="button"
                                    class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                    data-toggle="modal"
                                    data-target="#deleteModal{{$key}}"
                                    data-placement="top"
                                    title="{{trans('message.button.delete')}}"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                        @include('backend.meetingManagement.meeting.memberDetails.updateModal')
                        @include('backend.meetingManagement.meeting.memberDetails.deleteModal')

                    </td>
                </tr>
            @endforeach
            </tbody>
        @else
            <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                <label class="form-control badge badge-pill"
                       style="text-align:  center; font-size: 18px;">
                    <i class="fas fa-ban" style="margin-top: 6px"></i>
                    {{ trans('message.commons.no_record_found') }}
                </label>
            </div>
        @endif
    </table>
</div>