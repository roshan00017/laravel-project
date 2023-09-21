<?php

namespace App\Http\Controllers\VoiceCallManagement;

use App\Http\Controllers\BaseController;
use App\Models\VoiceCallManagement\AudioFile;
use App\Repositories\VoiceCallManagementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class VoiceRecordController extends BaseController
{
    private AudioFile $voiceRecord;

    private VoiceCallManagementRepository $voiceCallRepository;

    public function __construct(AudioFile $voiceRecord, VoiceCallManagementRepository $voiceCallRepository)
    {
        parent::__construct();
        $this->voiceRecord = $voiceRecord;
        $this->voiceCallRepository = $voiceCallRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = '/voiceRecordManagement';
            $data['page_route'] = 'voiceRecordManagement';
            $data['results'] = $this->voiceCallRepository->getAllRecorded($request);
            $data['page_title'] = getLan() == 'np' ? 'भ्वाइस रेकर्ड व्यवस्थापन' : 'Voice Record management';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',

            ];

            return view('backend.voiceCallManagement.voiceRecords.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
