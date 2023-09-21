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
    </tr>
    </thead>
    <tbody>
    @foreach ($visitLogDetails as $key => $data)
        <tr>
            <th scope="row {{ setFont() }}">
                {{ ($visitLogDetails->currentpage() - 1) * $visitLogDetails->perpage() + $key + 1 }}
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
        </tr>
        @include('backend.modal.delete_modal')
    @endforeach

    </tbody>
</table>
<span class="float-right" style="margin-top: 20px !important;">
    {{ $visitLogDetails->appends(request()->except('page'))->links() }}
</span>