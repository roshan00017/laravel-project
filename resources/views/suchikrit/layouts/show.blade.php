<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                       {{ getLan() =='np' ? 'सुझाव' : 'Suggestion' }} {{trans('message.pages.roles.details')}}
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
                            {{trans('suggestion.date_time')}}
                            </label>
                            @php
                             $time =    \Carbon\Carbon::parse($data->created_at)->format('g:i A')
                            @endphp
                            @if(isset($data->submit_date_np))
                                <input type="text"
                                    class="form-control"
                                    value="{{ getLan()=='np' ? $data->submit_date_np : $data->submit_date_en}} {{ $time }}"
                                    readonly
                                >
                            @else
                                <input type="text"
                                    class="form-control"
                                    value="" 
                                    readonly
                                >
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="">
                            {{trans('suggestion.suggestion_type')}}
                            </label>
                                <input type="text"
                                    class="form-control"
                                    value="{{ getLan()=='np' ? $data->suggestion_categories->name : $data->suggestion_categories->name_ne}}"
                                    readonly
                                >
                            
                        </div>
                    </div>     
                </div>



            <div class="modal-body">
                <div class="row">
                    <div class= " row container {{setFont()}}">
                    <label for="">
                    {{trans('suggestion.suggester_details')}} :
                            </label>
                    </div>
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="">
                            {{trans('suggestion.name')}}
                            </label>
                            @if(isset($data->name))
                                <input type="text"
                                    class="form-control"
                                    value="{{$data->name}}"
                                    readonly
                                >
                            @else
                                <input type="text"
                                    class="form-control"
                                    value="" 
                                    readonly
                                >
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="">
                            {{trans('suggestion.mobile_no')}}
                            </label>
                            @if(isset($data->mobile))   
                                <input type="text"
                                    class="form-control"
                                    value="{{$data->mobile}}"
                                    readonly
                                >
                            @else
                                <input type="text"
                                    class="form-control"
                                    value="" 
                                    readonly
                                >
                            @endif
                        </div>
                        <div class="form-group col-md-6 {{setFont()}}">
                            <label for="">
                            {{trans('suggestion.email')}}
                            </label>
                            @if(isset($data->email))   
                                <input type="text"
                                    class="form-control"
                                    value="{{$data->email}}"
                                    readonly
                                >
                            @else
                                <input type="text"
                                    class="form-control"
                                    value="" 
                                    readonly
                                >
                            @endif
                        </div>
                    </div>     
                </div>



                <div class="modal-body">
                        <div class="row">
                            <div class= "row container {{setFont()}}">
                            <label for="">
                            {{trans('suggestion.suggestion_details')}} :
                                    </label>
                        </div>
                                <div class="form-group col-md-6 {{setFont()}}">
                                    <label for="">
                                    {{trans('suggestion.suggestion')}}
                                    </label>
                                    @if(isset($data->suggestions))
                                        <input type="text"
                                            class="form-control"
                                            value="{{$data->suggestions}}"
                                            readonly
                                        >
                                    @else
                                        <input type="text"
                                            class="form-control"
                                            value="" 
                                            readonly
                                        >
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{setFont()}}">
                                    <label for="">
                                    {{trans('suggestion.file')}}
                                    </label>
                                    @if(isset($data->file))
                                        <input type="file"
                                            class="form-control"
                                            value="{{$data->file}}"
                                            readonly
                                        >
                                    @else
                                        <input type="text"
                                            class="form-control"
                                            value="N/A" 
                                            readonly
                                        >
                                    @endif
                                </div>
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
</div>
