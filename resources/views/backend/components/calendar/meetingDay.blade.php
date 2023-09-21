
<?php
$applyMeetingDays = $meetingDays;
?>

@if(count($applyMeetingDays) > 0)
    @foreach($applyMeetingDays as $meetingDay)
        <br/><small class="text-danger">{{$meetingDay->title}}</small>
    @endforeach
@endif

