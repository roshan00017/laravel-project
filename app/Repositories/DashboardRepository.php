<?php

namespace App\Repositories;

use App\Models\Appointment\Appointment;
use App\Models\Appointment\DailyWorkingSchedule;
use App\Models\Dcc\Service;
use App\Models\EDMIS\DcDispatchBook;
use App\Models\EDMIS\DcDocument;
use App\Models\EDMIS\DcRegisterBook;
use App\Models\Grevience\Complaint;
use App\Models\Grevience\IncidentReporting;
use App\Models\Grevience\Suggestion;
use App\Models\Meetings\Meeting;
use App\Models\TokenManagement\Token;
use Carbon\Carbon;

class DashboardRepository
{
    public function getTotalDispatch()
    {
        $query = DcDispatchBook::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fiscal_year_id', currentFy()->id)->count();
    }

    public function getTodayDispatch()
    {
        $query = DcDispatchBook::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query = $query->whereDate('created_at', Carbon::now()->toDateString())->count();
    }

    public function getTotalRegisterBook()
    {
        $query = DcRegisterBook::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fiscal_year_id', currentFy()->id)->count();
    }

    public function getTodayRegister()
    {
        $query = DcRegisterBook::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query = $query->whereDate('regd_date_ad', Carbon::now()->toDateString())->count();
    }

    public function getTotalDcDocument()
    {
        $query = DcDocument::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fiscal_year_id', currentFy()->id)->count();
    }

    public function getTodayDocument()
    {
        $query = DcDocument::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query = $query->whereDate('created_at', Carbon::now()->toDateString())->count();
    }

    public function getTotalAppointment()
    {
        $query = Appointment::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }
        //check appointment user module
        CommonRepository::appointUserModule($query, 'visiting_section', 'visiting_to_person_id');

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getTodayAppointment()
    {
        $query = Appointment::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }
        //check appointment user module
        CommonRepository::appointUserModule($query, 'visiting_section', 'visiting_to_person_id');

        return $query = $query->whereDate('appointment_date_ad', Carbon::now()->toDateString())->count();
    }

    public function getTotalSchedule()
    {
        $query = DailyWorkingSchedule::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }
        //check appointment user module
        //check appointment user module
        CommonRepository::appointUserModule($query, 'schedule_type', 'schedule_to_person_id');

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getTodaySchedule()
    {
        $query = DailyWorkingSchedule::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }
        //check appointment user module
        CommonRepository::appointUserModule($query, 'schedule_type', 'schedule_to_person_id');

        return $query = $query->whereDate('schedule_date_en', Carbon::now()->toDateString())->count();
    }

    //total complaints and its sources start

    public function getTotalComplaints()
    {
        $query = Complaint::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getTodayComplaint()
    {
        $query = Complaint::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query = $query->whereDate('created_at', Carbon::now()->toDateString())->count();
    }

    public function getTodaySuggestion()
    {
        $query = Suggestion::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query = $query->whereDate('created_at', Carbon::now()->toDateString())->count();
    }

    public function getTodayIncident()
    {
        $query = IncidentReporting::query();

        return $query = $query->whereDate('created_at', Carbon::now()->toDateString())->count();
    }

    public function getTotalBySourceId($sourceId)
    {
        $query = Complaint::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where(['fy_id' => currentFy()->id, 'complaint_source_id' => $sourceId])->count();
    }

    public function getTotalsuggestion()
    {
        $query = Suggestion::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getTotalincident()
    {
        $query = IncidentReporting::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getLatestDispatchBook()
    {
        $query = DcDispatchBook::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->orderBy('id', 'desc')->limit(7)->get();

    }

    public function getLatestRegisterBook()
    {
        $query = DcRegisterBook::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->orderBy('id', 'desc')->limit(7)->get();

    }

    public function getLatestDcDocument()
    {
        $query = DcDocument::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->orderBy('id', 'desc')->limit(7)->get();

    }

    public function getTotalMeetingByStstusId($statusId = null)
    {
        $query = Meeting::query();

        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }
        if ($statusId != null) {
            $query = $query->where('meeting_status_id', $statusId);
        }

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getLatestMeeting()
    {
        $query = Meeting::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->orderBy('id', 'desc')->limit(7)->get();
    }

    public function getLatestToken()
    {
        $query = Token::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->orderBy('id', 'desc')->limit(5)->get();
    }

    //Token start from here

    public function getTotalToken()
    {
        $query = Token::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fy_id', currentFy()->id)->count();
    }

    public function getStartingToken()
    {
        $query = Token::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where(['fy_id' => currentFy()->id, 'status_title_en' => null])->count();
    }

    public function getCompleteToken()
    {
        $query = Token::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where('fy_id', currentFy()->id)->whereNotIn('status_title_en', ['Null', 'Cancelled'])->count();
    }

    public function getCanceledToken()
    {
        $query = Token::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->where(['fy_id' => currentFy()->id, 'status_title_en' => 'Cancelled'])->count();
    }
    //Token ends here

    public function getTodayMeeting()
    {
        $query = Meeting::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query = $query->whereDate('meeting_date_ad', Carbon::now()->toDateString())->count();
    }

    public function getTotalService()
    {
        $query = Service::query();
        if (userInfo()->client_id != null) {
            $query = $query->where('client_id', userInfo()->client_id);
        }

        return $query->count();
    }

    public function getDailyWorkingSchedule()
    {
        $query = DailyWorkingSchedule::query();
        if (clientInfo()->id != null) {
            $query = $query->where('client_id', clientInfo()->id);
        }

        return $query->orderBy('id', 'desc')->limit(7)
            ->get(['title', 'start_time', 'end_time', 'duration', 'location']);
    }
}
