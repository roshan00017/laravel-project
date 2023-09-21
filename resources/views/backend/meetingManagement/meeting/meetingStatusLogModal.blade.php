@php
    $name = setName();
@endphp
<div class="modal fade" id="meetingStatusLogModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ trans('meeting.meeting.page_title') }} {{ trans('message.pages.common.code') }}
                    {{ $data->code }} {{ getLan() == 'np' ? 'को लग' : 'Log' }}
                    {{ trans('message.pages.roles.details') }}

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $results = $meetingRepo->getMeetingStatusLog(@$data->id);
                ?>
                <div class="row">
                    @if (sizeof($results) > 0)
                        <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline">
                                <thead class="th-header">
                                    <tr class="{{ setFont() }}">
                                        <th class="{{ setFont() }}" width="1%">
                                            {{ trans('message.commons.s_n') }}</th>
                                        <th class="{{ setFont() }}" width="3%">
                                            {{ trans('message.commons.status') }}
                                        </th>
                                        <th class="{{ setFont() }}" width="5%">
                                            {{ trans('meeting.meeting.status_update_details') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $key => $log)
                                        <tr>
                                            <th scope=row {{ setFont() }}>
                                                {{ ++$key }}
                                            </th>
                                            <td class="{{ setFont() }}">
                                                @if (isset($log->meetingStatus))
                                                    {{ getLan() == 'np' ? $log->meetingStatus->name_np : $log->meetingStatus->name_en }}
                                                @endif

                                            </td>

                                            <td class="{{ setFont() }}">
                                                @if (isset($log->updateBy))
                                                    @if (userInfo()->id == $log->updated_by)
                                                        {{ getLan() == 'np' ? 'तपाईं' : 'You' }}
                                                    @else
                                                        {{ getLan() == 'np' ? $log->updateBy->full_name_np : $log->meetingStatus->full_name_en }}
                                                    @endif
                                                    <i class="fa fa-calendar"></i>
                                                    {{ getLan() == 'np' ? $log->updated_date_np : $log->updated_date_en }}
                                                    <i class="fa fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($log->created_at)->format('g:i A') }}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                            <label class="form-control badge badge-pill" style="text-align:  center; font-size: 18px;">
                                <i class="fas fa-ban" style="margin-top: 6px"></i>
                                {{ trans('message.commons.no_record_found') }}
                            </label>
                        </div>
                    @endif

                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{ setFont() }}"
                        data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{ trans('message.button.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
