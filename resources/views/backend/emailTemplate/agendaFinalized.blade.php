@php
    $data = $agendaList[0]; // Assuming the first data is at index 0
@endphp
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="{{ setFont() }}">
        @if (isset(systemSetting()->app_name))
            {{ getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
        @else
            {{ env('APP_NAME') }}
        @endif
        | {{ trans('auth.addUser.title') }}

    </title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
    <style>
        @font-face {
            font-family: "Kalimati";
            src: url("../fonts/kalimati.ttf") format("truetype");
        }

        .f-kalimati {
            font-family: "Kalimati";
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="{{ url('/') }}" title="logo" target="_blank">
                                <img width="80" src="{{ asset('images/logo.jpg') }}" title="logo" alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding-top: 17px; font-size: 23px;"><strong
                                class="f-kalimati">{{ trans('agenda.greeting') }}
                                <br>
                                @if (isset($memberName))
                                    {{ $memberName }}
                                @endif
                            </strong></td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;" class="f-kalimati">
                            {{ trans('agenda.message') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="height:18px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="text-align:left; padding-top: 5px;" class="f-kalimati">
                            {{ trans('agenda.meeting_title') }}
                            <strong class="{{ setFont() }}">
                                @if (isset($meetingInfo->title))
                                    {{ $meetingInfo->title }}
                                @endif
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;" class="f-kalimati">
                            {{ trans('agenda.meeting_code') }}
                            <strong class="{{ setFont() }}">
                                @if (isset($meetingInfo->code))
                                    {{ $meetingInfo->code }}
                                @endif
                            </strong>

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;" class="f-kalimati">
                            {{ trans('agenda.meeting_date') }}
                            <strong class="{{ setFont() }}">
                                @if (isset($meetingInfo->meeting_date_ad))
                                    {{ getLan() == 'np' ? $meetingInfo->meeting_date_bs : $meetingInfo->meeting_date_ad }}
                                @endif
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;" class="f-kalimati">
                            {{ trans('agenda.meeting_link') }}
                            <strong class="{{ setFont() }}">
                                @if ($meetingInfo->meeting_mode == 'online')
                                    @if (isset($meetingInfo->meeting_url))
                                        <a href="{{ $meetingInfo->meeting_url }}">{{ $meetingInfo->meeting_url }}</a>
                                    @endif
                                @else
                                    {{ trans('agenda.offline') }}
                                @endif
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06); padding: 14px;">
                                <thead>
                                    <tr class="{{ setFont() }}">
                                        <th width="10px" style="padding-bottom: 14px">
                                            {{ trans('message.commons.s_n') }}
                                        </th>
                                        <th style="padding-bottom: 14px">
                                            {{ trans('meeting.meeting_agenda_list.title') }}
                                        </th>
                                        <th style="padding-bottom: 14px">
                                            {{ trans('agenda.meeting_description') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendaList as $key => $data)
                                        <tr>
                                            <th scope=row class="f-kalimati" style="padding-bottom: 14px">
                                                {{ ++$key }}
                                            </th>
                                            <td style="padding-bottom: 14px" class="f-kalimati">
                                                @if (isset($data->title))
                                                    {{ $data->title }}
                                                @endif
                                            </td>

                                            <td style="padding-bottom: 14px" class="f-kalimati">
                                                @if ($meetingInfo->description)
                                                    {{ $meetingInfo->description }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    <tr>
                        <td style="text-align:left; padding-top: 5px;" class="f-kalimati"">
                            {{ trans('agenda.message1') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="height:50px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; <?php echo date('Y'); ?>
                                <strong class="{{ setFont() }}">
                                    @if (systemSetting()->app_name)
                                        {{ getLan() == 'np' ? systemSetting()->app_name_np : systemSetting()->app_name }}
                                    @else
                                        {{ env('APP_NAME') }}
                                    @endif
                                </strong>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
