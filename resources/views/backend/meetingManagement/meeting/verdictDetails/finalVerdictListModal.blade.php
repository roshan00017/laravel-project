@php
    $name = setName()
@endphp
<div class="modal fade"
     id="verdictListModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('meeting.meeting.page_title')}}   {{trans('message.pages.common.code')}}    {{ $data->code }} {{ getLan() =='np' ? 'को  निर्णय सूची' :'Verdict List' }} {{ trans('message.pages.roles.details') }}

                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $verdictList = @$meetingRepo->getMeetingVerdictList(@$data->id);
                ?>
                <div class="row">
                    @if(sizeof($verdictList) > 0)
                        <div class="card-body">
                            <table
                                    class="table table-bordered table-striped dataTable dtr-inline"
                            >
                                <thead class="th-header">
                                <tr class="{{setFont()}}">
                                    <th class="{{setFont()}}" width="1%">
                                        {{ trans('message.commons.s_n') }}
                                    </th>
                                    <th>
                                        {{trans('meeting.meeting.agenda_title')}}
                                    </th>
                                    <th>
                                        {{trans('meeting.final_verdict.feedback')}}
                                    </th>
                                    <th>
                                        {{trans('meeting.final_verdict.feedback_by')}}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($verdictList as $key=>$verdict)
                                    <tr>
                                        <th scope=row {{setFont()}}>
                                            {{  ++ $key }}
                                        </th>
                                        <td>
                                             @if(isset($verdict->agenda->title))
                                                {{$verdict->agenda->title}}
                                             @endif
                                        </td>
                                        <td>
                                            @if(isset($verdict->feedback))
                                                {{$verdict->feedback}}
                                             @endif
                                        </td>
                                        <td>
                                            @if(isset($verdict->meeting_member->name_en))
                                                {{$verdict->meeting_member->name_en}}
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
