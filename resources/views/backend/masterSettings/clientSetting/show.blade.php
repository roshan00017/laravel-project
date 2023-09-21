@php
    $name = setName();
@endphp
<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(isset($data->school))
                        {{ getLan() =='en' ? $data->school->name_en : $data->school->name_np }}
                    
                    @endif
                        {{$page_title}}

                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


            <div class="row">
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="">
                            {{trans('common.local_body')}}
                            </label>
                            @if(isset($data->client))
                            <input type="text" 
                                   class="form-control" 
                                   value="{{ getLan() =='np' ? $data->client->name_np : $data->client->name_en }}" 
                                   readonly
                            >
                            @else
                            <input type="text" 
                                   class="form-control" 
                                   value="{{ trans('common.system_setting') }}" 
                                   readonly
                            >

                            @endif
                    </div>

                
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="">
                                {{trans('clientSetting.client_setting')}}
                            </label>
                            @if(isset($data->master_setting))
                            <input type="text" 
                                   class="form-control" 
                                   value="{{ getLan()=='np' ? $data->master_setting->name_np : $data->master_setting->name_en}}" 
                                   readonly
                            >
                            @else
                            <input type="text" class="form-control" value="" readonly>

                            @endif
                    </div>

                    <div class="form-group col-md-12 {{setFont()}}">
                            <label for="">
                                {{trans('clientSetting.value')}}
                            </label>
                            @if(isset($data->value))
                            <textarea class="form-control" rows="4" readonly>{{$data->value}}
                           </textarea>
                        @else
                            <input type="textarea"
                                   class="form-control"
                                   value="" 
                                   readonly
                            >

                        @endif
                    </div>

                

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
