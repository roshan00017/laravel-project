<?php

namespace App\Repositories\FrontEnd;

use App\Models\BasicDetails\ComplaintSource;
use App\Models\CallRouting\CallRoutingNumberManagement;
use App\Models\Dcc\Service;
use App\Models\Dcc\ServiceRelatedDocument;
use App\Models\Grevience\Complaint;
use App\Models\Grevience\IncidentReporting;
use App\Models\Grevience\Suggestion;
use App\Models\MasterSettings\Notice;
use App\Models\Meetings\Meeting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    private Suggestion $suggestion;

    public function __construct(Suggestion $suggestion)
    {
        $this->suggestion = $suggestion;
    }

    public function getSuggestion()
    {
        //        $query = Suggestion::query()
        //            ->leftJoin('suggestion_categories as sc', 's.suggestion_category_id', 'sc.id');
        //        return $query->select('sc.name as category', 'sc.name_ne as category_ne', 's.*')
        //        ->paginate();
        return DB::table('suggestions as s')
            ->leftJoin('suggestion_categories as sc', 's.suggestion_category_id', 'sc.id')
            ->select('sc.name as category', 'sc.name_ne as category_ne', 's.*')
            ->paginate();

    }

    public function getSuggestionCount()
    {
        return DB::table('suggestions as s')
            ->leftJoin('suggestion_categories as sc', 's.suggestion_category_id', 'sc.id')
            ->groupBy('suggestion_category_id', 'sc.name', 'sc.name_ne')
            ->select('suggestion_category_id', DB::raw('count(*) as total'), 'sc.name', 'sc.name_ne')
            ->get();

    }

    public function getCountComplaintSource()
    {
        return ComplaintSource::query()->orderBy('depth')->get();

    }

    public function getComplaintCount()
    {
        return DB::table('complaints as c')
            ->leftJoin('form_categories as fc', 'fc.id', 'c.form_category_id')
            ->groupBy('form_category_id', 'fc.name', 'fc.name_ne')
            ->select('form_category_id', DB::raw('count(*) as total'), 'fc.name', 'fc.name_ne')
            ->get();

    }

    public function getTotalComplaint(): int
    {

        $query = Complaint::query();
        $query = $query->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id]);

        return $query->count();
    }

    public function getTotalSuggestion(): int
    {

        $query = Suggestion::query();
        $query = $query->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id]);

        return $query->count();
    }

    public function getTotalIncident(): int
    {

        $query = IncidentReporting::query();
        $query = $query->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id]);

        return $query->count();
    }

    public function getLatestMeetings()
    {
        $query = Meeting::query();
        if (clientInfo()->id != null) {
            $query = $query->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'is_public' => true]);
        }

        return $query->orderBy('id', 'desc')->limit(7)
            ->get(['title', 'meeting_date_ad', 'meeting_date_bs', 'meeting_status_id']);
    }

    public function getJitsiLiveMeeting()
    {

        $query = Meeting::query();
        $query = $query->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id, 'is_public' => true, 'meeting_date_ad' => Carbon::now()->toDateString()])->whereNotNull('meeting_iframe');

        return $query->first();
    }

    public function getNoticeDetails()
    {
        $query = Notice::query();

        return $query->where(['fy_id' => currentFy()->id, 'client_id' => clientInfo()->id])->orderBy('id', 'DESC')->get();
    }

    public function getServices()
    {
        $query = Service::query();

        return $query->orderBy('id', 'desc')->limit(7)
            ->select('name_np', 'name_en', 'id')
            ->get();
    }

    public function getDocument($serviceId)
    {
        $query = ServiceRelatedDocument::query();

        return $query
            ->where('service_id', $serviceId)
            ->orderBy('id', 'desc')
            ->select('document_detail_en', 'document_detail_np', 'service_rate')
            ->get();
    }

    public function getEmergencyContact()
    {
        $query = CallRoutingNumberManagement::query();

        return $query->where(['client_id' => clientInfo()->id, 'type' => 'emergency_contact'])->first();
    }
}
