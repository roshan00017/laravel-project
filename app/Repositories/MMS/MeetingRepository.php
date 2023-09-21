<?php

namespace App\Repositories\MMS;

use App\Helpers\DateConverter;
use App\Models\Meetings\FinalVerdict;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingAgendaList;
use App\Models\Meetings\MeetingMember;
use App\Models\Meetings\MeetingStatusLog;
use App\Models\VoiceCallManagement\AudioFile;
use App\Repositories\CommonRepository;

class MeetingRepository
{
    private DateConverter $dateConverter;

    private Meeting $meeting;

    public function __construct(DateConverter $dateConverter, Meeting $meeting)
    {
        $this->dateConverter = $dateConverter;
        $this->meeting = $meeting;
    }

    public function getAllMeetings($request)
    {
        if (getLan() == 'np') {
            $date = 'meeting_date_bs';
        } else {
            $date = 'meeting_date_ad';
        }
        $result = $this->meeting;
        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }

        if ($request->meeting_status_id != null) {
            $result = $result->where('meeting_status_id', $request->meeting_status_id);
        }

        if ($request->meeting_category_id != null) {
            $result = $result->where('meeting_category_id', $request->meeting_category_id);
        }
        if ($request->agenda != null) {
            $result = $result->where('agenda_finalized', $request->agenda);
        }

        if ($request->code != null) {
            $result = $result
                ->orWhere('code', 'LIKE', '%'.$request->code.'%');
        }
        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('meeting_date_ad', decrypt($request->today));
        }
        //status by dashboard
        if ($request->status != null) {
            $result = $result->where('meeting_status_id', decrypt($request->status));

        }

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($result);
        }

        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getMeetingStatusLog($meetingId)
    {

        $query = MeetingStatusLog::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getMeetingAgendaList($meetingId)
    {

        $query = MeetingAgendaList::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getMeetingMemberList($meetingId)
    {

        $query = MeetingMember::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getMeetingMemberContactNoList($meetingId)
    {

        $query = MeetingMember::query();

        return $query
            ->where('meeting_id', $meetingId)->pluck('contact_no');
    }

    public function getMeetingVerdictList($meetingId)
    {

        $query = FinalVerdict::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getAgendaListByMeeting($meetingId)
    {

        $query = MeetingAgendaList::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAgendaList($meetingId)
    {

        $query = MeetingAgendaList::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getMeetingMemberByMeeting($meetingId)
    {

        $query = MeetingMember::query();

        return $query
            ->where('meeting_id', $meetingId)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllMeetingLinkList($request)
    {

        $result = $this->meeting;
        if (getLan() == 'np') {
            $date = 'meeting_date_bs';
        } else {
            $date = 'meeting_date_ad';
        }
        $result = $this->meeting;
        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }
        if ($request->title != null) {
            $result = $result
                ->orWhere('title', 'LIKE', '%'.$request->title.'%');
        }

        if ($request->code != null) {
            $result = $result->where('code', $request->code);
        }
        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($result);
        }

        return $result
            ->where('meeting_mode', 'online')
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getCountMemberByMeeting($meetingId)
    {

        return MeetingMember::query()->where('meeting_id', $meetingId)->count();
    }

    public function getAudioFileByMeeting($meetingCode)
    {

        return AudioFile::query()->where('module_unique_id', $meetingCode)->first();
    }
}
