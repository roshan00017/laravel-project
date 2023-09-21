@extends('frontend.layouts.welcome')
@section('content')


<section class="breadcrumbs">
    <div class="custom-container">
        <nav class="breadcrumbs__nav">
            <ul class="breadcrumbs__nav-menu">
                <li>
                    <a href="{{url('/')}}" class="breadcrumb__link {{setFont()}}">
                        <i class="fa-solid fa-home"></i>
                        {{ trans('frontendSuggestion.suggestion.home_page') }}
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)" class="breadcrumb__link {{setFont()}}">
                        {{@$page_title}}
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<section class="inner__title">
    <div class="custom-container">
        <div class="inner__title-content">
{{--            <h1 class="content__title {{setFont()}}">--}}
{{--                {{$page_title}}--}}
{{--            </h1>--}}

            <p class="content__desc {{setFont()}}">
                {{ __('frontEndDashboard.Meeting_management_info') }}
            </p>
        </div>
    </div>
</section>
{{-- Latest Meeting --}}
<section>
    <div class="tables__section">
        <div class="custom-container">
            <div class="table__grid">
                <div class="table__responsive">
                    <table class="left__table">
                        <thead>
                            <tr>
                                <th class="{{setFont()}}">
                                    {{ trans('frontendMeetingManagement.title') }}
                                </th>
                                <th class="{{setFont()}}">
                                    {{ trans('frontendMeetingManagement.date') }}
                                </th>
                                <th class="{{setFont()}}">
                                    {{ trans('frontendMeetingManagement.status') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latest_meetings as $key=>$data)
                            <tr>
                                <td class="{{setFont()}}">
                                    @if(isset($data->title))
                                    {{ $data->title }}
                                    @endif

                                </td>


                                <td class="{{setFont()}}">
                                    @if(isset($data->meeting_date_bs))

                                    {{ getLan() == 'np' ? $data->meeting_date_bs : $data->meeting_date_ad }}

                                    @endif

                                </td>

                                <td class="{{setFont()}}">
                                    @if(isset($data->meeting_status_id))
                                    @if($data->meeting_status_id == 1)
                                    {!! getLan() == 'np' ? 'सुरु हुन बाकी' : 'Pending' !!}
                                    @elseif($data->meeting_status_id == 2)
                                    {!! getLan() == 'np' ? 'रद्द गरिएको' : 'Canceled' !!}
                                    @elseif($data->meeting_status_id == 3)
                                    {!! getLan() == 'np' ? 'स्थगित भएको' : 'Postponed' !!}
                                    @elseif($data->meeting_status_id == 4)
                                    {!! getLan() == 'np' ? 'अघि सरेको' : 'Preponed' !!}
                                    @elseif($data->meeting_status_id == 5)
                                    {!! getLan() == 'np' ? 'पूरा भएको' : 'Execute' !!}
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="card shadow p-2 mb-4 bg-white rounded">
                    <div id="meeting">

                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

@include('frontend.chart.mmsChart')
@endsection