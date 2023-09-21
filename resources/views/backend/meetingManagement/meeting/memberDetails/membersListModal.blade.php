@php
    $name = setName()
@endphp
<div class="modal fade"
     id="memberListModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('meeting.meeting.page_title')}}   {{trans('message.pages.common.code')}}    {{ $data->code }} {{ getLan() =='np' ? 'को  सदस्य सूची' :'Member List' }} {{ trans('message.pages.roles.details') }}

                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $memberList = @$meetingRepo->getMeetingMemberList(@$data->id);
                ?>
                <div class="row">
                    @if(sizeof($memberList) > 0)
                        <div class="card-body">
                            <table
                                    class="table table-bordered table-striped dataTable dtr-inline"
                            >
                                <thead class="th-header">
                                <tr class="{{setFont()}}">
                                    <th class="{{setFont()}}" width="1%">
                                        {{ trans('message.commons.s_n') }}
                                    </th>
                                    <th class="{{setFont()}}" width="20%">
                                        {{ trans('message.pages.meeting_member.name') }}
                                    </th>
                                    <th width="20%">
                                        {{ trans('message.pages.meeting_member.office') }}
                                    </th>

                                    <th width="20%">
                                        {{ trans('message.pages.common.designation') }}
                                    </th>

                                    <th width="20%">
                                        {{ trans('message.pages.meeting_member.contact_no') }}
                                    </th>

                                    <th width="20%">
                                        {{ trans('message.pages.meeting_member.email') }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($memberList as $key=>$member)
                                    <tr>
                                        <th scope=row {{setFont()}}>
                                            {{  ++ $key }}
                                        </th>

                                        <td class="{{ setFont() }}">
                                            {{ getLan() == 'np' ? $member->name_np : $member->name_en }}
                                        </td>

                                        <td>
                                            @if (isset($member->office))
                                                {{ $member->office }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($member->post))
                                                {{ $member->post }}
                                            @endif
                                        </td>

                                        <td>
                                            @if (isset($member->contact_no))
                                                {{ $member->contact_no }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($member->email))
                                                {{ $member->email }}
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-md-12 {{setFont()}}"
                             style="padding-top: 10px"
                        >
                            <label class="form-control badge badge-pill"
                                   style="text-align:  center; font-size: 18px;"
                            >
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{trans('message.commons.no_record_found')}}
                            </label>
                        </div>
                    @endif

                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}"
                            data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
