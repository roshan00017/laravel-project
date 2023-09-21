<?php

namespace App\Http\Controllers\EDMIS;

use App\Http\Controllers\BaseController;
use App\Models\BasicDetails\DcStatus;
use App\Models\EDMIS\DcDispatchBook;
use App\Models\EDMIS\DcDispatchBookStatusLog;
use App\Models\User;
use App\Repositories\CommonRepository;
use App\Repositories\EDMIS\DispatchRepository;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class DcDispatchBookStatusLogController extends BaseController
{
    protected CommonRepository $model;

    protected DispatchRepository $dispatchRepository;

    private int $menuId = 25;

    public function __construct(
        DispatchRepository $dispatchRepository
    ) {
        parent::__construct();
        //set the model
        $this->dispatchRepository = $dispatchRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['results'] = $this->dispatchRepository->getAllDcDispatchBookLog($request);
            $data['request'] = $request;
            $data['page_url'] = 'dcDispacthBookStatusLogDetails';
            $data['load_css'] = [
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',

            ];
            $data['page_title'] = getLan() == 'np' ? ' चलानी किताब लग विवरण' : 'Dispatch Book Log Details';

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['statusList'] = DcStatus::select('id', $name.' '.'as name')->get();

            return view('backend.edmis.dcDispacthBookStatusLogDetails.index', $data);
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
                $data['value'] = DcDispatchBook::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['results'] = DcDispatchBookStatusLog::query()->where('dc_dispatch_book_id', $data['value']->id)->get();

                if ($data) {

                    $data['page_title'] = getLan() == 'np' ? 'चलानी किताब' : 'Dispatch Book';
                    $data['page_url'] = 'dcDispatchBook';

                    return view('backend.edmis.dcDispacthBookStatusLogDetails.logDetails', $data);
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
