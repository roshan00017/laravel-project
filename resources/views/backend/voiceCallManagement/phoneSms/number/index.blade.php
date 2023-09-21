    @if(isset($numberList) )
        <table id="example2"
               class="table table-bordered table-striped dataTable dtr-inline">
            <thead class="th-header">
            <tr class="{{setFont()}}">
                <th width="5%">
                    {{trans('message.commons.s_n')}}
                </th>
                <th>
                    {{trans('voiceCallManagement.mobileNo')}}
                </th>
                @if($campaignDetails->campaign_service =='PHONE')
                    <th>
                        {{trans('voiceCallManagement.status')}}
                    </th>
                    <th>
                        {{ trans('voiceCallManagement.duration') }}
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($numberList as $key=>$value)
                <tr>
                    <th scope=row {{setFont()}}>
                        {{++$key}}
                    </th>
                    <td class="{{setFont()}}">
                        @if($value->number !=null)
                            {{$value->number}}
                        @endif
                        @if(allowEdit())

                            <button type="button"
                                    class="btn btn-secondary btn-xs rounded-pill {{setFont()}}"
                                    data-toggle="modal"
                                    data-target="#editMobile{{$key}}"
                                    data-placement="top"
                                    title="{{trans('message.button.edit')}}"
                            >
                                @if($campaignDetails->campaign_service =='PHONE')
                                    <i class="fas fa-phone"></i>
                                @else
                                    <i class="fas fa-sms"></i>
                                @endif
                            </button>
                        @endif

                        @if(allowEdit())

                            <button type="button"
                                    class="btn btn-info btn-xs rounded-pill {{setFont()}}"
                                    data-toggle="modal"
                                    data-target="#editMobile{{$key}}"
                                    data-placement="top"
                                    title="{{trans('message.button.edit')}}"
                            >
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        @endif
                        @if(allowDelete() && systemAdmin() == true && $campaignDetails->status !='Completed')
                            <button type="button"
                                    class="btn btn-danger btn-xs rounded-pill {{setFont()}}"
                                    data-toggle="modal"
                                    data-target="#deleteMobileNumberModal{{$key}}"
                                    data-placement="top"
                                    title="{{trans('message.button.delete')}}"
                            >
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif

                    </td>
                    @if($campaignDetails->campaign_service =='PHONE')
                        <td class="{{setFont()}}">
                            @if (isset($value->status))
                                @if($value->status =='not started')
                                    <button class="btn btn-warning btn-xs rounded-pill">
                                        {{ strtoupper($value->status) }}

                                    </button>
                                @elseif($value->status =='completed')
                                    <button class="btn btn-success btn-xs rounded-pill">
                                        {{ strtoupper($value->status) }}

                                    </button>
                                @elseif($value->status =='failed')
                                    <button class="btn btn-danger btn-xs rounded-pill">
                                        {{ strtoupper($value->status) }}

                                    </button>
                                @else
                                    <button class="btn btn-danger btn-xs rounded-pill">
                                        {{ strtoupper($value->status) }}

                                    </button>
                                @endif
                            @endif

                        </td>
                        <td class="{{setFont()}}">
                            &nbsp;
                            @if (isset($value->duration))
                                {{ $value->duration }} {{ getLan() =='np' ? 'सेकन्ड':'Seconds'  }}
                            @endif

                        </td>
                    @endif
                    @include('backend.voiceCallManagement.phoneSms.number.editMobileNumber')
                    @include('backend.voiceCallManagement.phoneSms.number.deleteMobileNumber')


                </tr>

            @endforeach
            </tbody>
        </table>
        <span class="float-right {{setFont()}}">
                                            {!! urldecode(str_replace("/?","?",$numberList->appends(Request::all())->render())) !!}
                                        </span>
    @else
        <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
            <label class="form-control badge badge-pill"
                   style="text-align:  center; font-size: 18px;">
                <i class="fas fa-ban" style="margin-top: 6px"></i>
                {{trans('message.commons.no_record_found')}}
            </label>
        </div>
    @endif