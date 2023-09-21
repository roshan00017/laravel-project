
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>गुनासो</title>
    <link rel='stylesheet' href='{{ asset('design/css/bootstrap.min.css') }}' />
    <link rel='stylesheet' href='{{ asset('design/css/report.css') }}' />
</head>
<body>
    <div class="card">
        <div class="card-body">
            <table id="example2"
            class="table table-bordered table-striped dataTable dtr-inline">
            <thead class="th-header">
                <tr class="{{ setFont() }}">
                    <th>
                        {{ trans('message.commons.s_n') }}
                    </th>

                    <th>
                        {{ trans('complaints.date') }}
                    </th>

                    <th>
                        {{ trans('complaints.ticket_no') }}
                    </th>

                    <th>
                        {{ trans('complaints.types_of_complaint') }}
                    </th>

                    <th>
                        {{ trans('complaints.complainant') }}
                    </th>

                    <th>
                        {{ trans('complaints.complaint_priority') }}
                    </th>

                    <th>
                        {{ trans('complaints.user_to_add') }}
                    </th>

                    <th>
                        {{ trans('complaints.assigned_office') }}
                    </th>

                    <th>
                        {{ trans('complaints.source_of_complaints') }}
                    </th>

                    <th>
                        {{ trans('complaints.grievance_status') }}
                    </th>

                    
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $key => $data)
                    <tr>

                        <th scope=row {{ setFont() }}>
                            {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                        </th>

                        <td class="{{ setFont() }}">
                            {{ getLan() == 'np' ? $data->complaint_date_np : $data->complaint_date_en }}

                        </td>

                        <td>

                        </td>
                        <td>
                            @if (isset($data->complaintType))
                                {{ getLan() == 'np' ? $data->complaintType->name_ne : $data->complaintType->name }}
                            @endif
                        </td>

                        <td class="{{ setFont() }}">
                            @if (isset($data->name_ne))
                                {{ getLan() == 'np' ? $data->name_ne : $data->name_en }}
                            @endif
                        <td>

                            @if (isset($data->complaintseverityType))
                                {{ getLan() == 'np' ? $data->complaintseverityType->name_ne : $data->complaintseverityType->name }}
                            @endif
                        </td>
                        </td>

                        <td>

                        </td>

                        <td>
                            @if (isset($data->officeList->name_en))
                                {{ getLan() == 'np' ? $data->officeList->name_en : $data->officeList->name_np }}
                            @endif
                        </td>


                        <td>
                            @if (isset($data->complaintSource->name))
                                {{ getLan() == 'np' ? $data->complaintSource->name_ne : $data->complaintSource->name }}
                            @endif
                        </td>

                        <td class="{{ setFont() }}">
                            @include('backend.components.buttons.status')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            
        </div>
    </div>
    
</body>
</html>
       
   


