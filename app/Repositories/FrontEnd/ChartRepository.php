<?php

namespace App\Repositories\FrontEnd;

use App\Models\Report\AppointmentReportView;
use App\Models\Report\ComplaintReportView;
use App\Models\Report\DcDispatchBookReportView;
use App\Models\Report\DcRegdBookReportView;
use App\Models\Report\IncidentReportView;
use App\Models\Report\MeetingReportView;
use App\Models\Report\SuggestionReportView;
use App\Models\Report\TokenReportView;
use App\Repositories\CommonRepository;
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

    public function monthWiseMeeting($month = null, $status = null)
    {
        $query = $this->meetingReport
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(meeting_id) as totals'));

        return $query->get();
    }

    public function getMonthWiseComplaintBySource($month = null, $status = null)
    {
        $query = $this->meetingReport
            ->where(['fy_id' => currentFy()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(meeting_id) as totals'));

        if (clientInfo()->id) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function monthWiseDcDispatchBook($month = null, $status = null)
    {
        $query = $this->dcDispatchBookReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(dc_dispatch_id) as totals'));

        return $query->get();
    }

    public function monthWiseDcRegisterBook($month = null, $status = null)
    {
        $query = $this->dcRegdBookReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(dc_regd_id) as totals'));

        return $query->get();
    }

    public function monthWiseComplaintStatusData($month = null, $status = null)
    {
        $query = $this->complaintReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(complaint_id) as totals'));

        return $query->get();
    }

    public function monthWiseComplaintSourceData($month = null, $source = null)
    {
        $query = $this->complaintReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'source_id' => $source])
            ->select(DB::raw('COUNT(complaint_id) as totals'));

        return $query->get();
    }

    public function monthWiseSuggestionTypeData($month = null, $category_id = null)
    {
        $query = $this->suggestionReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'category_id' => $category_id])
            ->select(DB::raw('COUNT(suggestion_id) as totals'));

        return $query->get();
    }

    public function monthWiseIncidentData($month = null)
    {
        $query = $this->incidentReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month])
            ->select(DB::raw('COUNT(incident_id) as totals'));

        return $query->get();
    }

    public function getMonthWiseTokenServiceData($month_code, $module = null)
    {
        $query = $this->tokenReportView
            ->where(['month_code' => $month_code, 'module' => $module])
            ->select(DB::raw('COUNT(token_id) as totals'));

        if (clientInfo()->id) {
            CommonRepository::checkClientId($query);
        }

        return $query->get();
    }

    public function monthWiseAppointment($month = null, $status = null)
    {
        $query = $this->appointmentReportView
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month, 'status_id' => $status])
            ->select(DB::raw('COUNT(appointment_id) as totals'));

        return $query->get();
    }

    public function statusWiseServiceToken($month_code = null, $status = null)
    {
        $query = $this->tokenReportView;
        if ($status == 'st') {
            $query = $query->whereNull('status_title_en');
        } elseif ($status == 'ca') {
            $query = $query->where('status_title_en', 'Cancelled');
        } elseif ($status == 'co') {
            $query = $query->whereNotIn('status_title_en', ['Null', 'Cancelled']);
        }
        $query = $query
            ->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'month_code' => $month_code])
            ->select(DB::raw('COUNT(token_id) as totals'));

        return $query->get();
    }
}
