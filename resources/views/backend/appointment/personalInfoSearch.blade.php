
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="form-group  col-md-4 {{setFont()}}">
                {!! Form::text('mobile_no',$request->mobile_no,
                        ['class'=>'form-control mobileNo',
                        'id'=>'mobile_no',
                        'placeholder'=>trans('appointment.mobile_no'),
                        'autocomplete'=>'off',
                        ])
                !!}

            </div>

            <div class="form-group  col-md-4 {{setFont()}}">

                {!! Form::email('email',$request->email,
                        ['class'=>'form-control email',
                        'placeholder'=>trans('appointment.email'),
                        'autocomplete'=>'off',
                        ])
                !!}

            </div>

        </div>
        <div class="row {{setFont()}}">
            <div class="col-md-12">
                <p class="text-danger">
                    {{trans('appointment.personal_info_note')}}
                    :&nbsp;{{trans('appointment.personal_info_filter_message')}}</p>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>