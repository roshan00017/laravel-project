<?php

namespace App\Http\Controllers\Meetings;

use App\Events\AgendaFinalizedFileEvent;
use App\Facades\NepaliDate;
use App\Helpers\FileUploadLibraryHelper;
use App\Http\Controllers\BaseController;
use App\Models\Meetings\FinalVerdictFile;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingStatusLog;
use App\Models\TokenManagement\Token;
use App\Models\TokenManagement\TokenLog;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use App\Repositories\MMS\MeetingRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FinalVerdictFileController extends BaseController
{
    protected CommonRepository $model;

    protected MeetingRepository $meetingRepository;

    protected LogsRepository $logsRepository;

    private int $menuId = 9;

    public function __construct(FinalVerdictFile $finalVerdictFile, LogsRepository $logsRepository,
        MeetingRepository $meetingRepository)
    {
        parent::__construct();
        $this->model = new CommonRepository($finalVerdictFile);
        $this->logsRepository = $logsRepository;
        $this->meetingRepository = $meetingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/finalVerdictFile';
            $data['page_route'] = 'finalVerdictFile';
            $data['meetingList'] = Meeting::query()->whereNotIn('meeting_status_id', [2, 5])->orderBy('id', 'desc')->get();
            $data['meetingCodeList'] = Meeting::query()->orderBy('id', 'desc')->get();
            $data['results'] = $this->model->getFinalVerdictFile($request);

            $data['page_title'] = getLan() == 'np' ? 'बैठक निर्णय फाइल' : 'Final Verdict File';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'js/custom_app.min.js',
                'js/selector.min.js',
                'js/meetingAgenda.js',
            ];

            $data['filePath'] = FinalVerdictFile::FINAL_VERDICT_FILE_PATH;

            return view('backend.meetingManagement.finalVerdictFile.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            //check if files are uploaded
            if ($request->hasFile('verdictFile')) {
                $files = $request->file('verdictFile');

                if ($request->hasFile('verdictFile')) {
                    $files = [];
                    foreach ($request->file('verdictFile') as $file) {
                        $fileName = FileUploadLibraryHelper::setFileUploadName($file, $request->meeting_id);
                        $files[] = $fileName;
                        FileUploadLibraryHelper::setFileUploadPath($file, $fileName, FinalVerdictFile::FINAL_VERDICT_FILE_PATH);
                    }
                    $data['files'] = implode(',', $files);
                }
                $data['uploaded_by'] = userInfo()->id;
                $data['uploaded_date_en'] = Carbon::now()->toDateString();
                $data['uploaded_date_np'] = NepaliDate::create(Carbon::now())->toBS();
                DB::beginTransaction();
                //check school data exist
                $create = $this->model->create($data);

                // insert log
                $this->logsRepository->insertLog($create->id, $this->menuId, 1);

                if ($create) {
                    //set image path
                    FileUploadLibraryHelper::setFileUploadPath($file, $data['files'], FinalVerdictFile::FINAL_VERDICT_FILE_PATH);
                }

                DB::commit();

                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            }

            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.insertMessage'),
            ]);
            // return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $value = FinalVerdictFile::find($id);
            DB::beginTransaction();
            $data = $request->all();
            $data['uploaded_by'] = userInfo()->id;
            $data['uploaded_date_en'] = Carbon::now()->toDateString();
            $data['uploaded_date_np'] = NepaliDate::create(Carbon::now())->toBS();
            if ($value->files != null) {
                FileUploadLibraryHelper::deleteExistingFile($value->files, FinalVerdictFile::FINAL_VERDICT_FILE_PATH);
            }
            if ($request->hasFile('verdictFile')) {
                $files = [];
                foreach ($request->file('verdictFile') as $file) {
                    $fileName = FileUploadLibraryHelper::setFileUploadName($file, $request->meeting_id);
                    $files[] = $fileName;
                    FileUploadLibraryHelper::setFileUploadPath($file, $fileName, FinalVerdictFile::FINAL_VERDICT_FILE_PATH);
                }
                $data['files'] = implode(',', $files);
            }
            $update = $this->model->update($data, $id);
            if ($update) {
                //set image path
                if (isset($imageSuccess)) {
                    FileUploadLibraryHelper::setFileUploadPath($request->verdictFile, $data['files'], FinalVerdictFile::FINAL_VERDICT_FILE_PATH);
                }
                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
            }
            // insert log
            $this->logsRepository->insertLog($value->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $value = $this->model->find($id);

            if ($value) {
                if ($value->files != null) {
                    FileUploadLibraryHelper::deleteExistingFile($value->files, FinalVerdictFile::FINAL_VERDICT_FILE_PATH);
                }
                DB::beginTransaction();
                $data['deleted_by'] = auth()->user()->id;
                $this->model->update($data, $id);
                $this->model->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 4);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));
            } else {
                session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function fileStatusUpdate($id, Request $request): RedirectResponse
    {
        try {

            $id = (int) $id;
            $value = Meeting::query()->find($id);

            if ($value) {
                DB::beginTransaction();
                $statusUpdate = Meeting::query()->where('id', $id)->update(['meeting_status_id' => 5]);

                if ($statusUpdate) {
                    $status_update = [
                        'status_title_en' => 'Execute',
                        'status_title_np' => 'पूरा भएको ',
                    ];
                }

                $meeting = Meeting::find($value->id);

                $tokenNo = $meeting->token->token_no;
                $module_status_id = $meeting->token->module_status_id;
                $serviceLogs = [
                    'token_no' => $tokenNo,
                    'module_status_id' => $module_status_id,
                    'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'date_en' => Carbon::now()->toDateString(),
                ];
                $mergedValue = array_merge($status_update, $serviceLogs);
                TokenLog::create($mergedValue);

                // Token Update
                $token = Token::where('module_unique_id', $value->id)->first();
                $token->fill($status_update);
                $token->save();

                // Meeting Status Log Update
                $logs = MeetingStatusLog::where('meeting_id', $value->id)->first();
                $updated_data = [
                    'meeting_id' => $value->id,
                    'meeting_status_id' => 5,
                    'updated_by' => userInfo()->id,
                    'updated_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'updated_date_en' => Carbon::now()->toDateString(),
                    'remarks' => $value->remarks,
                ];
                $logs->create($updated_data);

                DB::commit();

                $getMemberList = $this->meetingRepository->getMeetingMemberList($value->id);
                foreach ($getMemberList as $member) {
                    //  if (smsSetting(userInfo()->client_id)) {
                    //      SmsHelper::sendSms(smsSetting()->sms_token, smsSetting()->sms_from, $member->contact_no, $message);
                    //  }
                    if (isset($member->email)) {
                        $memberName = getLan() == 'np' ? $member->name_np : $member->name_en;
                        $mailData = [
                            'memberName' => $memberName,
                            'meetingInfo' => $value,
                            'email' => $member->email,
                        ];
                        if (mailSetting(userInfo()->client_id)) {
                            AgendaFinalizedFileEvent::dispatch($mailData);
                        }
                    }
                }

                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
