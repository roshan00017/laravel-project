<div class="modal fade"
     id="runCampaign"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-primary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{trans('message.commons.add')}}
                    <span style="font-size: 14px;"> {{trans('validation.pages.common.mandatory_field_message')}} </span>
                </h4>
                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                >
                    <span aria-hidden="true"
                          data-toggle="tooltip"
                          title="Close"
                    >   &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'post',
                              // 'id'=>'addForm',
                              'url'=>'runCampaign',
                               'enctype' => 'multipart/form-data',
                              ])
                      !!}
                <div class="row">
                    <input type="hidden" name="campaign_id" value="{{$campaignDetails->id}}">
                    <input type="hidden" name="campaign_api_id" value="{{$campaignDetails->campaign_api_id}}">
                    <input type="hidden" name="campaign_service" value="{{$campaignDetails->campaign_service}}">
                    <input type="hidden" name="module_name" value="{{$campaignDetails->module_name}}">
                    @if($campaignDetails->campaign_service =='PHONE')
                        <div class="form-group col-md-12 {{setFont()}}">
                            <label for="inputName">
                                {{trans('voiceCallManagement.choseTheVoice')}}
                                <span class="text text-danger">
                                *
                            </span>
                            </label>
                            {!!Form::select('voice_input',   tingTingVoiceInput(),
                                Request::get('voice_input'),
                                ['class'=>'form-control select2',
                                'required',
                                'style'=>'width: 100%;','placeholder'=>
                                trans('voiceCallManagement.choseTheVoice')])
                            !!}
                        </div>
                    @endif


                    <div class="form-group col-md-12 {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.messageToSend')}}
                        </label>
                        {!! Form::textarea('message',null,
                                 ['class'=>'form-control',
                                 'placeholder'=>trans('voiceCallManagement.messageToSend'),
                                 'rows'=>'4',
                                  'required',
                                 'autocomplete'=>'off'
                                 ])
                         !!}
                    </div>

{{--                    <div class="form-group col-md-12 {{setFont()}}">--}}
{{--                        <label for="inputName">--}}
{{--                            {{trans('voiceCallManagement.messageToSend')}}--}}
{{--                        </label>--}}
{{--                        <input type="file" class="form-control-file" accept="audio/mpeg" name="audio_file">--}}
{{--                    </div>--}}

                    <div class="form-group col-md-4 schedule {{setFont()}}">
                        <label for="inputName">
                            {{trans('voiceCallManagement.schedule')}} ?
                        </label>
                        <br>
                        <input class="radio-button" type="radio" name="is_schedule"
                               onclick=""
                               value="1" style="margin-top: 2px">
                        {{ trans('meeting.meeting.yes') }}
                        &nbsp;
                        <input class="radio-button" type="radio" checked=""
                               name="is_schedule"
                               onclick="" value="0" style="margin-top: 2px">
                        {{ trans('meeting.meeting.no') }}

                    </div>
                    <div class="form-group col-md-4 dateBlock {{setFont()}}" style="display: none">
                        <label for="inputName">
                            {{trans('voiceCallManagement.schedule_date')}}
                            <label class="text text-danger">*</label>
                        </label>
                        @if(getLan() =='np')
                            {!! Form::text('date_bs', Request::get('date_bs'), [
                             'class' => 'form-control',
                            'placeholder' => trans('voiceCallManagement.schedule_date'),
                            'autocomplete' => 'off',
                            'readonly',
                            'id' => 'date_bs',
                           ]) !!}
                        @else

                            {!! Form::text('date_ad', Request::get('date_ad'), [
                          'class' => 'form-control',
                         'placeholder' => trans('voiceCallManagement.schedule_date'),
                         'autocomplete' => 'off',
                         'readonly',
                         'id' => 'date_ad',
                        ]) !!}
                        @endif


                    </div>
                    <div class="form-group col-md-4 timeBlock {{setFont()}}" style="display: none">
                        <label for="inputName">
                            {{ trans('meeting.meeting.time') }}
                            <label class="text text-danger">*</label>
                        </label>
                        <br>
                        {{ Form::time('time', Request::get('time'), [
                            'class' => 'form-control startTime',
                            'style' => 'width: 100%',
                            'id'=>'schedule_time',
                            'placeholder' => trans('meeting.meeting.time'),
                        ]) }}


                    </div>


                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">

                    <button type="submit"
                            class="btn btn-primary  rounded-pill"
                            id="btn-add"
                    >
                        <i class="fa fa-save"></i>
                        {{trans('voiceCallManagement.begin')}}
                    </button>
                    &nbsp;
                    <button type="button"
                            class="btn btn-danger  rounded-pill"
                            data-dismiss="modal"
                    >
                        <i class="fa fa-times-circle"></i>
                        {{trans('message.button.close')}}
                    </button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
