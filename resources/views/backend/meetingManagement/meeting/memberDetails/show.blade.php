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
                                <a href="{{ url('dashboard') }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{ trans('message.dashboard.page_title') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                   {{ trans('meeting.meeting.meeting') }}
                                </a>
                                </li>
    
                            <li class="breadcrumb-item">
                                    {{ $page_title }}
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ trans('message.button.list') }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
            <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            <div class="container-fluid">
                <div class="row">
                    @include('backend.meetingManagement.meeting.memberDetails.index')
                                    {!! Form::open([
                                        'method' => 'post',
                                        'id' => 'addForm',
                                        'url' => 'addMeetingMembers',
                                    ]) !!}
                    
                                    <input type="hidden" value="{{ $value->id }}" name="meeting_id">
                                    <input type="hidden" value="true" name="fromMeeting">
                                    @include('backend.meetingManagement.meeting.memberDetails.add')
                                    <div class="modal-footer justify-content-center {{ setFont() }}">
                                    <button type="submit"
                                            class="btn btn-primary  rounded-pill"
                                            id="btn-add"
                                    >
                                        <i class="fa fa-save"></i>
                                        {{trans('message.button.save')}}
                                    </button>
                                    &nbsp;
                                    @if(@$cancel_button == true)
                                        <a href="{{url(@$index_page_url)}}"
                                        class="btn btn-danger  rounded-pill {{setFont()}}"
                                        title="{{trans('message.button.close')}}"
                                        >
                                            <i class="fa fa-times-circle"></i>
                                            {{trans('message.button.close')}}
                                        </a>
                                    @else
                                        <button type="button"
                                                class="btn btn-danger  rounded-pill"
                                                data-dismiss="modal"
                                        >
                                            <i class="fa fa-times-circle"></i>
                                            {{trans('message.button.close')}}
                                        </button>
                                    @endif
                                </div>
                                    {!! Form::close() !!}

                                </div>

                            </div>


                        </div>

                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->
    </div>
@endsection
