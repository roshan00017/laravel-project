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
                                                    {{ trans('notification.notify_date') }}
                                                </th>
                                                <th>
                                                    {{ trans('notification.notify_title') }}
                                                </th>
                                                <th>
                                                    {{ trans('notification.notify_url') }}
                                                </th>
                                                <th>
                                                    {{ trans('notification.notify_type') }}
                                                </th>
                                                <th>
                                                    {{ trans('notification.notify_is_seen') }}
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
                                                        {{ getLan() == 'np' ? $data->notify_date_np : $data->notify_date_en }}
                                                    </td>
                                                    <td>
                                                        {{ getLan() == 'np' ? $data->title_np : $data->title_en }}
                                                    </td>
                                                    <td>
                                                        @if (isset($data->notify_url))
                                                            {{ $data->notify_url }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($data->notify_type))
                                                            {{ $data->notify_type }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($data->notification_read_date_en))
                                                            {{ trans('notification.seen') }}
                                                        @else
                                                            {{ trans('notification.unseen') }}
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