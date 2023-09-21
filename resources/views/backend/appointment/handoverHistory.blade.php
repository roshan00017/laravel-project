<table id="example2"
       class="table table-bordered table-striped dataTable dtr-inline">
    <thead class="th-header">
    <tr class="{{ setFont() }}">
        <th width="10px">
            {{ trans('message.commons.s_n') }}
        </th>


        <th>
            {{ trans('appointment.appointment_no') }}
        </th>

        <th>
            {{ trans('appointment.appointment_date') }}
        </th>

        <th>
            {{ trans('appointment.full_name') }}
        </th>

        <th>
            {{ trans('appointment.email') }}
        </th>

        <th>
            {{ trans('appointment.mobile_no') }}
        </th>
        <th>
            {{trans('message.commons.status')}}
        </th>

        <th width="13%">
            {{ trans('message.commons.action') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($results as $key => $data)
        <tr>
            <th scope="row {{ setFont() }}">
                {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
            </th>
            <td class="{{ setFont() }}">
                {{  $data->appointment_no  }}
            </td>

            <td class="{{ setFont() }}">
                {{ getLan() =='np' ?  $data->appointment_date_bs : $data->appointment_date_ad }}
                &nbsp;
                <i class="fa fa-clock"></i>
                {{ \Carbon\Carbon::parse(@$data->time)->format('g:i A') }}
            </td>


            <td class="{{setFont()}}">
                @if (isset($data->full_name))
                    {{ $data->full_name }}
                @endif
            </td>

            <td>
                @if (isset($data->email))
                    {{ $data->email }}
                @endif
            </td>
            <td>
                @if (isset($data->mobile_no))
                    {{ $data->mobile_no }}
                @endif
            </td>
            <td>
                @if (isset($data->visiting_status))
                    @if($data->visiting_status == 'v')
                        <button class="btn btn-xs btn-success rounded-pill {{setFont()}}">
                            {{ appointmentStatus($data->visiting_status) }}

                        </button>
                    @elseif($data->visiting_status == 'h')
                        <button class="btn btn-xs btn-info rounded-pill {{setFont()}}">
                            {{ appointmentStatus($data->visiting_status) }}

                        </button>
                    @endif
                @else
                    <button class="btn btn-xs btn-secondary rounded-pill {{setFont()}}">
                        {{  getLan() == 'np' ? 'भेटघाट हुन बाकी   ' : 'Not Visited' }}

                    </button>
                @endif
            </td>

            <td>
                @if (allowShow())
                    <a href="{{ route($page_route . '.' . 'show', hashIdGenerate($data->id)) }}"
                       class="btn btn-secondary btn-xs rounded-pill {{ setFont() }}"
                       title="{{ trans('message.button.show') }}">
                        <i class="fas fa-eye"></i>
                    </a>
                @endif
                &nbsp;
                @if (allowEdit())
                    <a href="{{ route($page_route . '.' . 'edit', hashIdGenerate($data->id)) }}"
                       class="btn btn-info btn-xs rounded-pill {{ setFont() }}"
                       title="{{ trans('message.button.edit') }}">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                @endif
                &nbsp;
                @if (allowDelete())
                    <button type="button"
                            class="btn btn-danger btn-xs rounded-pill {{ setFont() }}"
                            data-toggle="modal"
                            data-target="#deleteModal{{ $key }}"
                            data-placement="top"
                            title="{{ trans('message.button.delete') }}">


                        <i class="fas fa-trash"></i>
                    </button>
                @endif


            </td>
        </tr>
        @include('backend.modal.delete_modal')
    @endforeach

    </tbody>
</table>
<span class="float-right" style="margin-top: 20px !important;">
    {{ $results->appends(request()->except('page'))->links() }}
</span>