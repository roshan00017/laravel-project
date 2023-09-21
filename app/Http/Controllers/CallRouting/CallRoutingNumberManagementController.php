<?php

namespace App\Http\Controllers\CallRouting;

use App\Http\Controllers\BaseController;
use App\Models\CallRouting\CallRoutingNumberManagement;
use App\Repositories\CallRoutingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CallRoutingNumberManagementController extends BaseController
{
    private CallRoutingNumberManagement $callRouting;

    private CallRoutingRepository $callRoutingRepository;

    public function __construct(CallRoutingNumberManagement $callRouting, CallRoutingRepository $callRoutingRepository)
    {
        parent::__construct();
        $this->callRouting = $callRouting;
        $this->callRoutingRepository = $callRoutingRepository;
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = '/callRoutingNumberManagement';
            $data['page_route'] = 'callRoutingNumberManagement';
            $data['results'] = $this->callRoutingRepository->getAllRecorded($request);
            $data['page_title'] = getLan() == 'np' ? 'आकस्मिक सम्पर्क विवरण' : 'Emergency Contact Details';
            $data['request'] = $request;
            $data['load_js'] = [
                'js/callRouting.js',
            ];

            return view('backend.callRouting.numberManagement.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $value = CallRoutingNumberManagement::find($id);
            if ($value) {
                if ($request->type != 'emergency_contact') {

                    $this->callRoutingRepository->updateCallRoutingNumber($request);
                }
                //update local database
                CallRoutingNumberManagement::query()->where('id', $value->id)->update(['number' => $request->number, 'updated_by' => userInfo()->id]);

            }
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.updateMessage'),
            ]);
            //return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
