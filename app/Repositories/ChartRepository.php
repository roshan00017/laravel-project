<?php

namespace App\Repositories;

use App\Models\Report\AppointmentReportView;
use App\Models\Report\ComplaintReportView;
use App\Models\Report\DcDispatchBookReportView;
use App\Models\Report\DcRegdBookReportView;
use App\Models\Report\IncidentReportView;
use App\Models\Report\MeetingReportView;
use App\Models\Report\SuggestionReportView;
use App\Models\Report\TokenReportView;
use Illuminate\Support\Facades\DB;

class ChartRepository
{
    private MeetingReportView $meetingReport;

    private DcDispatchBookReportView $dcDispatchBookReportView;

    private DcRegdBookReportView $dcRegdBookReportView;

    private ComplaintReportView $complaintReportView;

    private SuggestionReportView $suggestionReportView;

    private IncidentReportView $incidentReportView;

    private TokenReportView $tokenReportView;

    private AppointmentReportView $appointmentReportView;

    public function __construct(MeetingReportView $meetingReport, DcDispatchBookReportView $dcDispatchBookReportView,
        DcRegdBookReportView $dcRegdBookReportView, ComplaintReportView $complaintReportView,
        SuggestionReportView $suggestionReportView, IncidentReportView $incidentReportView,
        TokenReportView $tokenReportView, AppointmentReportView $appointmentReportView)
    {
        $this->meetingReport = $meetingReport;
        $this->dcDispatchBookReportView = $dcDispatchBookReportView;
        $this->dcRegdBookReportView = $dcRegdBookReportView;
        $this->complaintReportView = $complaintReportView;
        $this->suggestionReportView = $suggestionReportView;
        $this->incidentReportView = $incidentReportView;
        $this->tokenReportView = $tokenReportView;
        $this->appointmentReportView = $appointmentReportView;
    }

    public function getMonthWiseMeeting($month = null, $status = null)
    {
        $query = $this->meetingReport
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(meeting_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseComplaintBySource($month = null, $status = null)
    {
        $query = $this->meetingReport
            ->where(['month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(meeting_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseDcDispatchBook($month = null, $status = null)
    {
        $query = $this->dcDispatchBookReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(dc_dispatch_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseDcRegisterBook($month = null, $status = null)
    {
        $query = $this->dcRegdBookReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(dc_regd_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseComplaintStatusData($month = null, $status = null)
    {
        $query = $this->complaintReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(complaint_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseComplaintSourceData($month = null, $source = null)
    {
        $query = $this->complaintReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'source_id' => $source])
            ->select(DB::raw('COUNT(complaint_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseSuggestionTypeData($month = null, $suggestion_id = null)
    {
        $query = $this->suggestionReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'suggestion_id' => $suggestion_id])
            ->select(DB::raw('COUNT(suggestion_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseIncidentData($month = null)
    {
        $query = $this->incidentReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month])
            ->select(DB::raw('COUNT(incident_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseTokenServiceData($month_code, $module = null)
    {
        $query = $this->tokenReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month_code, 'module' => $module])
            ->select(DB::raw('COUNT(token_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function getMonthWiseAppointment($month = null, $status = null)
    {
        $query = $this->appointmentReportView
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(appointment_id) as totals'));

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        //check appointment user module
        if (userInfo()->user_module == 'app') {
            $query = $query->where('appointment_to_person_id', appointAccessInfo()->appointment_access_user_id);
        }

        return $query->get();
    }
}
