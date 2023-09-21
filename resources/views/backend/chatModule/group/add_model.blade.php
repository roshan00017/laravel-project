<div class="modal fade"
     id="addModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-radius">
            <div
                    class="modal-header btn-primary rounded-pill"
            >
                <h4 class="modal-title {{setFont()}}">
                {{ trans('chat.add_member') }}
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
                <div class="row">
                @if (sizeof($otherMembers) > 0)
                <thead>
                        <tr>
                            <th>
                            <div class="icheck-primary">
                                <input type="checkbox" id="selectAllMembers">
                                <label for="selectAllMembers" class="{{ setFont() }}">{{ trans('chat.selection_all') }}</label>
                            </div>
                            </th>
                        </tr>
                        </thead>
                        @endif
                    <div class="col-md-12">

                        {!! Form::open(
                            ['method'=>'PUT',  
                            'route' => 'member.memberUpdate'])
                        !!}
                        @if (sizeof($otherMembers) > 0)
                        <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                       
                            

                        <tbody>
                        <input type="hidden"  name="group_id" value="{{$value->id}}">
                        <input type="hidden"  name="fy_id" value="{{$value->fy_id}}">
                        <input type="hidden"  name="client_id" value="{{$value->client_id}}">
                        

                            @foreach ($otherMembers as $key => $data)
                                <tr>
                                    <td>
                             
                                    {{ getLan() == 'np' ? $data->full_name_np : $data->full_name }}


                                    </td>
                                    <td>
                                    <span class="float-left">    &nbsp;  &nbsp;
                                    
                               
                                    <input type="checkbox" style="transform: scale(1.5);" class="memberCheckbox" id="checkboxPrimary{{ $key }}" name="user_id[]" value="{{$data->id}}">
                                            <label for="checkboxPrimary{{ $key }}"></label>
                                    </span>
                                    </td>

                                </tr>
                            
                                
                            @endforeach
                        </tbody>
                        </table>
                        @else
                                <div class="col-md-12 {{ setFont() }}" style="padding-top: 10px">
                                    <label class="form-control badge badge-pill"
                                        style="text-align:  center; font-size: 18px;">
                                        <i class="fas fa-ban" style="margin-top: 6px"></i>
                                        {{ trans('chat.no_record_found') }}
                                    </label>
                                </div>
                            @endif
                      

                    </div>
                    
                </div>
                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.addAction')
                 </div>
                 {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
