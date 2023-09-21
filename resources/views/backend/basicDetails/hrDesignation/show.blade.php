<div class="modal fade" id="showModal{{$key}}" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.pages.hr_designation.page_title')}}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.hr_designation.code')}}
                        </label>
                        @if(isset($data->code))
                        <input type="text" class="form-control" value="{{($data->code)}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.hr_designation.name_np')}}
                        </label>
                        @if(isset($data->name_np))
                        <input type="text" class="form-control" value="{{ $data->name_np}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.hr_designation.name_en')}}
                        </label>
                        @if(isset($data->name_en))
                        <input type="text" class="form-control" value="{{ $data->name_en}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.hr_designation.em_post')}}
                        </label>
                        @if(isset($data->emp_post))
                        <input type="text" class="form-control" value="{{ $data->emp_post}}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>
                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('message.pages.hr_designation.description') }}
                        </label>
                        @if(isset($data->description))
                        <input type="text" class="form-control" value="{{ $data->description }}" readonly>
                        @else
                        <input type="text" class="form-control" value="" readonly>

                        @endif
                    </div>

                    <?php

                    use App\Models\Logs\LoginLogs;
                    use Carbon\Carbon;

                    $logInfo = LoginLogs::query()
                        ->where('user_id', $data->id)
                        ->latest()->first();
                    if (isset($logInfo))
                        $lastLogin = Carbon::createFromTimeStamp(strtotime($logInfo->created_at))->diffForHumans()
                    ?>
                    @if(isset($logInfo))
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.profile.last_logged_in')}}
                        </label>
                        <input type="text" class="form-control" value="{{  $lastLogin  }}" readonly>

                    </div>
                    @endif
                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.commons.status')}}
                        </label>
                        <input type="text" class="form-control" value="{{ $data->status == 1 ? trans('message.button.active') : trans('message.button.inactive') }}" readonly>
                    </div>


                </div>


                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger rounded-pill {{setFont()}}" data-dismiss="modal">
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>