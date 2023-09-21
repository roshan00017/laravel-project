@php
    $name = setName();
@endphp
<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    @if(isset($data->school))
                        {{ getLan() =='en' ? $data->school->name_en : $data->school->name_np }}
                    @else
                        {{ getLan() =='en' ? 'System' : 'प्रणाली' }}
                    @endif
                        {{ trans('complaintSource.title') }}

                </h4>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{trans('message.pages.common.code')}}
                        </label>
                        @if(isset($data->code))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->code}}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>


                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                        {{trans('complaintSource.name')}}
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
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                        {{trans('complaintSource.name_en')}}
                        </label>
                        @if(isset($data->name_ne))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->name_ne}}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                        {{trans('complaintSource.depth')}}
                        </label>
                        @if(isset($data->depth))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->depth}}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                        {{trans('complaintSource.social_media_link')}}
                        </label>
                        @if(isset($data->social_media_link))
                            <input type="text"
                                   class="form-control"
                                   value="{{$data->social_media_link}}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

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
