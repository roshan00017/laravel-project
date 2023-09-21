<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>गुनासो</title>

</head>

<body>
    <div class="card">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                <thead class="th-header">
                    <tr class="{{ setFont() }}">
                        <th width="10px">
                            {{ trans('message.commons.s_n') }}
                        </th>

                        <th>
                            {{ trans('incidentReport.date') }}
                        </th>
                        <th>
                            {{ trans('incidentReport.name') }}
                        </th>
                        <th>
                            {{ trans('incidentReport.mobile_no') }}
                        </th>
                        <th>
                            {{ trans('incidentReport.email') }}
                        </th>
                        <th>
                            {{ trans('incidentReport.file') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $key => $data)
                        <tr>
                            <th scope=row {{ setFont() }}>
                                {{ ($results->currentpage() - 1) * $results->perpage() + $key + 1 }}
                            </th>
                            <td>
                                {{ getLan() == 'np' ? $data->incident_submit_date_np : $data->incident_submit_date_en }}
                            </td>
                            <td>
                                @if (isset($data->name))
                                    {{ $data->name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($data->mobile))
                                    {{ $data->mobile }}
                                @endif
                            </td>
                            <td>
                                @if (isset($data->email))
                                    {{ $data->email }}
                                @endif
                            </td>
                            <td>
                                @if (isset($data->file))
                                    {{ $data->file }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                        @include('backend.grevience.suggestions.show')
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>
