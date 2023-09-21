@if(sizeof($groupMember) > 0)
    <div class="table-responsive">
        <div class="card-body">
            {!! Form::open([
                'method' => 'post',
                'route' => $page_route . '.' . 'store',
            ]) !!}
            <table id="example2">
                <tbody>
                @foreach($groupMember as $key=>$data)
                    <tr>
                        <td>
                            <div class="direct-chat-msg card-footer">
                                <div class="direct-chat-infos clearfix">
                                    @if(isset(userInfo()->image))
                                        <div class="image user-panel" style="float: left; margin-right: 10px;">
                                            <img src="{{ asset('/storage/'.userProfilePath().userInfo()->image) }}"
                                                class="img-circle elevation-2"
                                                alt="User Image">
                                        </div>
                                    @else
                                        <div class="image user-panel" style="float: left; margin-right: 10px;">
                                            <img src="{{ url('/images/user.jpg') }}"
                                                class="img-circle elevation-2"
                                                alt="User Image">
                                        </div>
                                    @endif
                                    <div class="user-info {{setFont()}}" style="float: left; margin-right: 10px;">
                                        <span class="direct-chat-name">
                                            @if(isset($data->full_name))
                                                {{ getLan() == 'np' ? @$data->full_name_np : @$data->full_name }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="icheck-primary d-inline" style="float: left;">
                                        <input type="checkbox" id="checkboxPrimary{{ $key }}" name="total_members">
                                        <label for="checkboxPrimary{{ $key }}"></label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary {{setFont()}}">{{ trans('chat.create_group') }}</button>
            {!! Form::close() !!}
        </div>
    </div>
@else
    <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
        <label class="form-control badge badge-pill" style="text-align: center; font-size: 18px;">
            <i class="fas fa-ban" style="margin-top: 6px"></i>
            {{ trans('message.commons.no_record_found') }}
        </label>
    </div>
@endif
