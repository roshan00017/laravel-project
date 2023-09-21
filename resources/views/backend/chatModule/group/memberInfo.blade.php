@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 {{ setFont() }}">
                            {{ $page_title }}
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right {{ setFont() }}">
                            <li class="breadcrumb-item">
                                <a href="{{ url('dashboard') }} " class="{{ setFont() }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item {{ setFont() }}">
                                <a href="{{ url($page_url) }}">
                                    {{ $page_title }}
                                </a>
                            </li>

                            <li class="breadcrumb-item {{ setFont() }}">
                                {{ trans('message.commons.add') }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">


            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body p-0">
                        <div class="bs-stepper {{ setFont() }}">
                                @include('backend.chatModule.group.groupHeader')
                            </div>
                            {{-- added section--}}
                        @if(sizeof($groupMember) > 0)
                        <div class="table-responsive">
                            <div class="card-body">
                                {!! Form::open([
                                    'method' => 'post',
                                    'route' =>  'chat.groupChat',
                                ]) !!}

                                {{-- Selection--}}
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
                                <br>
                                {{-- Member Selection --}}
                              
                              


                                            <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header">
                                            <h3 class="card-title {{ setFont() }} font-weight-bold">{{ trans('chat.member_selection') }}</h3>
                                            <div class="card-tools">
                                            <label class="{{ setFont() }}">{{ trans('chat.total_member') }} &nbsp;</label>
                                            <span title="3 New Messages" class="badge badge-primary">{{$toal_members}}</span>
                                            </div>
                                            </div>
                                           
                               
                                           


                                            <div class="card-body">

                                            <div class="direct-chat-messages" >
                                            <table id="example2">
                                            <tbody style="display: flex; flex-wrap: wrap;">
                                            @foreach($groupMember as $key=>$data)
                                                <tr>
                                                    <td>

                                            <div class="direct-chat-msg" style="margin-left: 60px; margin-right:10px; margin-top:5px; padding-bottom:8px;"  >
                                            <div class="direct-chat-infos clearfix">


                                            <span class="direct-chat-name {{ setFont() }} float-left">
                                            @if(isset($data->full_name))
                                                {{ getLan() == 'np' ? @$data->full_name_np : @$data->full_name }}
                                            @endif
                                            </span>

                                          
                                            <span class="float-left">    &nbsp;  &nbsp;
                                             <input type="checkbox" style="transform: scale(1.5);" class="memberCheckbox" id="checkboxPrimary{{ $key }}" name="user_id[]" value="{{$data->id}}">
                                                    <label for="checkboxPrimary{{ $key }}"></label>
                                            </span>


                                            </div>
                                            
                                            @if(isset(userInfo()->image))
                                                            
                                                    <img src="{{ asset('/storage/'.userProfilePath().userInfo()->image) }}"
                                                        class="direct-chat-img"
                                                        alt="User Image">
                                                
                                            @else
                                                
                                                    <img src="{{ url('/images/user.jpg') }}"
                                                        class="direct-chat-img"
                                                        alt="User Image">
                                                
                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                            </td>
                                        </tr>
                                    @endforeach
                                   
                                </div>
                                </div>
                                <br>
                               
                      
                        @else
                            <div class="col-md-12 {{setFont()}}" style="padding-top: 10px">
                                <label class="form-control badge badge-pill {{ setFont() }}" style="text-align: center; font-size: 18px;">
                                    <i class="fas fa-ban" style="margin-top: 6px"></i>
                                    {{ trans('message.commons.no_record_found') }}
                                </label>
                            </div>
                        @endif

                            </div>
                            </tbody>
                                </table>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <a href="{{ route('chat.groupInfo') }}"
                                    class="btn btn-info rounded-pill float-left {{ setFont() }}">
                                    <i class="fa fa-arrow-alt-circle-left"></i>
                                    {{ trans('appointment.previous') }}
                                </a>
                                </div>
                               
                                <div class="col-md-6">
                                <button type="submit"
                                    class="btn btn-primary rounded-pill float-right {{ setFont() }} "
                                    id="btn-add">

                                    {{ trans('message.button.save') }}
                                    <i class="fa fa-arrow-alt-circle-right"></i>
                                </button>
                                </div>
                                </div>
                                
                                {!! Form::close() !!}
            </div>
        </section>


@endsection
