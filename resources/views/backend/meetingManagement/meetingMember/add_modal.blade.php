<div class="modal fade"
     id="addModal"
     aria-hidden="true"
     data-keyboard="false"
     data-backdrop="static"
>
    <div class="modal-dialog modal-xl">
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
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'post',
                       'url'=>'meetingMembers',
                       'enctype'=>'multipart/form-data',
                      'id'=>'addUerForm',
                       'autocomplete'=>'off'])
                !!}

                <div class="row {{setFont()}}">

                    <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                        {{trans('meeting.common.meeting_code')}}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {{Form::select('meeting_id',
                                    $meetingList->pluck('code','id'),
                                    Request::get('meeting_id'),
                                    ['class'=>'form-control select2',
                                    'required',
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('meeting.common.select_code'),
                                    'id' => 'meeting_code',
                                    ])
                        }}

                        {!! $errors->first('meeting_id', '<small class="text text-danger">:message</small>') !!}
                    </div>

                  {{-- <div class="form-group col-md-6 ">
                        
                    <label>
                        <span class="{{ setFont() }}">
                            {{ trans('meeting.meeting.karyapalika') }}
                        </span>
                    </label>
                    <br>
                    <input class="radio-button" type="radio" name="is_karyapalika"  value="1"
                    style="margin-top: 2px">
                    {{ trans('meeting.meeting.yes') }}
                    &nbsp;

                    <input class="radio-button" type="radio" name="is_karyapalika" checked value="0"
                        style="margin-top: 2px">
                    {{ trans('meeting.meeting.no') }}
                                       
                    </div> --}}

                   
                  
                    <div class="karyapalika form-group col-md-4 {{setFont()}}" style="display:none;">
                    <div class="form-group col-md-12 ">
                        @foreach($karyapalikamember as $member)
                            <p>{{  $member->name }}</p>
                        @endforeach
                    </div>
                    </div>

                  

                   

                    {{-- <div class="form-group col-md-4 {{setFont()}}">
                        <label for="inputName">
                            {{ trans('message.pages.meeting_member.client_id') }}
                            <span class="text text-danger">
                                    *
                                </span>
                        </label>
                        {{Form::select('role_id',
                                    $roleList->pluck('name','id'),
                                    Request::get('role_id'),
                                    ['class'=>'form-control select2',
                                    'required',
                                    'style'=>'width: 100%',
                                    'placeholder'=> trans('message.pages.role_access.select_user_type')
                                    ])
                     }}
                    </div> --}}

                     <div class='hidden-form row {{setFont()}}'>
                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('message.pages.common.name_en') }}
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('name_en',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.common.name_en'),
                                'autocomplete'=>'off',

                                ])
                        !!}
                        {!! $errors->first('name_en', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('message.pages.common.name_np') }}
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('name_np',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.common.name_np'),
                                'autocomplete'=>'off',

                                ])
                        !!}
                        {!! $errors->first('name_np', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputName">
                            {{ trans('message.pages.meeting_member.office') }}
                            <span class="text text-danger">
                                *
                                </span>
                        </label>
                        {!! Form::text('office',null,
                                ['class'=>'form-control',
                                'placeholder'=>trans('message.pages.meeting_member.office'),
                                'autocomplete'=>'off',
                               
                                ])
                        !!}
                        {!! $errors->first('office', '<small class="text text-danger">:message</small>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label>
                            {{ trans('message.pages.common.designation') }}
                        </label>

                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('post',null,
                                ['class'=>'form-control',
                                'id'=>'login_user_name',
                                'placeholder'=>trans('message.pages.common.designation'),
                           
                                ])
                        !!}
                        {!! $errors->first('post', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label>
                            {{ trans('message.pages.meeting_member.contact_no') }}
                        </label>
                        <label class="text text-danger">
                            *
                        </label>

                        {!! Form::text('contact_no',null,
                                ['class'=>'form-control mobileNo',
                                'placeholder'=>trans('message.pages.meeting_member.contact_no'),
                                ])
                        !!}
                        {!! $errors->first('contact_no', '<span class="text text-danger">:message</span>') !!}
                    </div>

                    <div class="form-group col-md-4">
                        <label>
                            {{ trans('message.pages.meeting_member.email') }}
                        </label>
                        

                        {!! Form::email('email',null,
                                ['class'=>'form-control',
                                'id'=>'email',
                        
                                'placeholder'=>trans('message.pages.meeting_member.email'),
                                ])
                        !!}
                        {!! $errors->first('email', '<span class="text text-danger">:message</span>') !!}
                    </div>
                    

                        <div class="form-group col-md-4 {{setFont()}}">
                            @include('backend.meetingManagement.meetingMember.is_invite.add_invite')
                        </div>                        
                      
                </div>
                        </div>

                <div class="modal-footer justify-content-center {{setFont()}}">

                    @include('backend.components.buttons.addAction')
                </div>
                
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
