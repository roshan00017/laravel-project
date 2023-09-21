<div class="modal fade" id="showModal{{ $key }}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{ setFont() }}">
                    {{ getLan() == 'en' ? $data->full_name : $data->full_name_np }}
                    {{ getLan() == 'np' ? 'प्रयोगकर्ता' : 'User' }} {{ trans('message.pages.roles.details') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.pages.users_management.user_type') }}
                        </label>
                        @if (isset($data->role))
                            <input type="text" class="form-control"
                                value="{{ getLan() == 'en' ? $data->role->name_en : $data->role->name_np }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">{{ trans('common.user_module') }}</label>
                        @if (isset($data->user_module))
                            <input type="text" class="form-control" value="{{ $data->user_module }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    @if (isset($data->user_module) && $data->user_module === 'edmis')
                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">{{ trans('message.pages.users_management.ward_no') }}</label>
                            @if (isset($data->ward_no))
                                <input type="text" class="form-control" value="{{ $data->ward_no }}" readonly>
                            @else
                                <input type="text" class="form-control" value="" readonly>
                            @endif
                        </div>

                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">{{ trans('message.pages.users_management.branch_id') }}</label>
                            @if (isset($data->branch_id))
                                <input type="text" class="form-control" value="{{ $data->branch_id }}" readonly>
                            @else
                                <input type="text" class="form-control" value="" readonly>
                            @endif
                        </div>

                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">{{ trans('message.pages.users_management.employee_id') }}</label>
                            @if (isset($data->employee_id))
                                <input type="text" class="form-control" value="{{ $data->employee_id }}" readonly>
                            @else
                                <input type="text" class="form-control" value="" readonly>
                            @endif
                        </div>
                    @endif
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.pages.users_management.full_name') }}
                        </label>
                        @if (isset($data->full_name))
                            <input type="text" class="form-control"
                                value="{{ getLan() == 'en' ? $data->full_name : $data->full_name_np }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    @if (isset($data->user_module) && $data->user_module === 'app')
                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">
                                {{ trans('appointment.department') }}
                            </label>
                            @if (isset($data->access_user_type))
                                <input type="text" class="form-control"
                                    value="{{ appointmentDepartment($data->access_user_type) }}" readonly>
                            @else
                                <input type="text" class="form-control" value="" readonly>
                            @endif
                        </div>


                        @if (isset($data->access_user_type) && $data->access_user_type === 'om')

                            <div class="form-group col-md-4 {{ setFont() }}">
                                <label for="">
                                    {{ trans('appointment.employee') }}
                                </label>
                                @if (isset($data->employee))
                                    <input type="text" class="form-control"
                                        value="{{ getLan() == 'np' ? $data->employee->first_name_np : $data->employee->first_name_en }}"readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                        @elseif (isset($data->access_user_type) && $data->access_user_type === 'km')
                            <div class="form-group col-md-4 {{ setFont() }}">
                                <label for="">
                                    {{ trans('appointment.elected_person') }}
                                </label>
                                @if (isset($data->employee))
                                    <input type="text" class="form-control"
                                        value="{{ getLan() == 'np' ? $data->electedPerson->name_np : $data->electedPerson->name_en }}"readonly>
                                @else
                                    <input type="text" class="form-control" value="" readonly>
                                @endif
                            </div>
                        @endif

                    @endif


                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.pages.users_management.login_user_name') }}
                        </label>
                        @if (isset($data->login_user_name))
                            <input type="text" class="form-control" value="{{ $data->login_user_name }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.pages.users_management.login_email_address') }}
                        </label>
                        @if (isset($data->email))
                            <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.pages.profile.address') }}
                        </label>
                        @if (isset($data->address))
                            <input type="text" class="form-control" value="{{ $data->address }}" readonly>
                        @else
                            <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>


                    <?php
                    use App\Models\Logs\LoginLogs;
                    use Carbon\Carbon;
                    $logInfo = LoginLogs::query()
                        ->where('user_id', $data->id)
                        ->latest()
                        ->first();
                    if (isset($logInfo)) {
                        $lastLogin = Carbon::createFromTimeStamp(strtotime($logInfo->created_at))->diffForHumans();
                    }
                    ?>
                    @if (isset($logInfo))
                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">
                                {{ trans('message.pages.profile.last_logged_in') }}
                            </label>
                            <input type="text" class="form-control" value="{{ $lastLogin }}" readonly>

                        </div>
                    @endif

                    @if ($data->image != null)
                        <div class="form-group col-md-4 {{ setFont() }}">
                            <label for="">
                                {{ trans('message.pages.users_management.user_image') }}
                            </label>
                            <br>
                            <img src="{{ asset('/storage/' . $filePath . '/' . $data->image) }}" alt="User"
                                class="rounded-pill" style="width: 60px; height: 60px">
                            <a href="{{ URL::to('/storage/' . $filePath . '/' . $data->image) }}" target="_blank"
                                class="btn btn-secondary btn-xs rounded-pill" data-placement="top"
                                title="{{ trans('message.pages.common.viewFile') }}" style="margin: 10px 0 0 10px;">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="javascript:void(0)" style="margin: 10px 0 0 10px;"
                                class="btn btn-danger btn-xs rounded-pill deleteFile" data-id="{{ $data->id }}"
                                data-widget="{{ $page_url }}"
                                title="{{ trans('message.pages.common.deleteFile') }}">
                                <i class="fa fa-trash">
                                </i>
                            </a>
                        </div>
                    @endif


                    <div class="form-group col-md-4 {{ setFont() }}">
                        <label for="">
                            {{ trans('message.commons.status') }}
                        </label>
                        <input type="text" class="form-control"
                            value="{{ $data->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}"
                            readonly>
                    </div>


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
