<div class="modal fade"
     id="showModal{{$key}}"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-content-radius">
            <div class="modal-header btn-secondary rounded-pill">
                <h4 class="modal-title {{setFont()}}">
                    {{ getLan() =='en' ? $data->full_name : $data->full_name_np }}    {{ getLan() =='np' ? 'प्रयोगकर्ता' : 'User' }} {{trans('message.pages.roles.details')}}
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
                            {{trans('service_related_document.common.service_type')}}
                        </label>
                        @if(isset($data->serviceType))
                            <input type="text"
                                   class="form-control"
                                   value="{{ getLan()=='np' ? $data->serviceType->name_np : $data->serviceType->name_en}} "
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
                            {{trans('service_related_document.common.service')}}
                        </label>
                        @if(isset($data->service))
                            <input type="text"
                                   class="form-control"
                                   value=" {{ getLan()=='np' ? $data->service->name_np  : $data->service->name_en}}"
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
                            {{ trans('service_related_document.common.service_rate') }}
                        </label>
                        @if(isset($data->service_rate))
                            <input type="text"
                                   class="form-control"
                                   value=" {{$data->service_rate}}"
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
                            {{ trans('service_related_document.common.service_time') }}
                        </label>
                        @if(isset($data->service_time))
                            <input type="text"
                                   class="form-control"
                                   value=" {{$data->service_time}}"
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
                        {{ getLan()=='np' ?  trans('service_related_document.common.details_np')   :  trans('service_related_document.common.details_en') }}
                        </label>
                        @if(isset($data->document_detail_np))
                        <textarea rows="2" class="form-control" readonly>
                                <?php echo getLan() == 'np' ? $data->document_detail_np : $data->document_detail_en; ?>
                            </textarea>
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
                            >

                        @endif
                    </div>

                    

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="">
                            {{ trans('service_related_document.common.department') }} 
                        </label>
                        @if(isset($data->department))
                            <input type="text"
                                   class="form-control"
                                   value=" {{getLan()=='np' ? $data->department->name_np :  $data->department->name_en}}"
                                   readonly
                            >
                        @else
                            <input type="text"
                                   class="form-control"
                                   value="" readonly
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
</div>
