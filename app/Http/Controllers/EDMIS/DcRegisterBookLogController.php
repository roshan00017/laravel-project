<?php

namespace App\Http\Controllers\edmis;

use App\Http\Controllers\Controller;
use App\Models\BasicDetails\DcStatus;
use App\Models\EDMIS\DcRegisterBook;
use App\Models\EDMIS\DcRegisterBookLog;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DartaKitabRepository;
use App\Repositories\LogsRepository;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DcRegisterBookLogController extends Controller
{
    private CommonRepository $model;

    private LogsRepository $logsRepository;

    private DartaKitabRepository $dartaKitabRepository;

    private int $menuId = 35;

    public function __construct(
        DcRegisterBookLog $dcRegisterBookLog,
        LogsRepository $logsRepository,
        DartaKitabRepository $dartaKitabRepository,
    ) {
        // set the model
        $this->model = new CommonRepository($dcRegisterBookLog);
        $this->logsRepository = $logsRepository;
        $this->dartaKitabRepository = $dartaKitabRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/dcRegisterBookStatusLogDetails';
            $data['page_route'] = 'dcRegisterLogBook';
            $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब लग' : 'Register Book Log';
            $data['show_button'] = true;
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
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_app.min.js',
                'js/custom_search.js',

            ];

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['statusList'] = DcStatus::select('id', $name.' '.'as name')->get();

            $data['results'] = $this->dartaKitabRepository->getAllDcRegisterBookLog($request);

            return view('backend.edmis.dcRegisterBookLog.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function show($id)
    {

        try {

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = DcRegisterBook::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['results'] = DcRegisterBookLog::query()->where('dc_regd_book_id', $data['value']->id)->get();

                if ($data) {

                    $data['page_title'] = getLan() == 'np' ? 'दर्ता किताब' : 'Register Book';
                    $data['page_url'] = 'dcRegisterBook';

                    return view('backend.edmis.dcRegisterBookLog.logDetails', $data);
                }

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('dcRegisterBook');
            }

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }
}
