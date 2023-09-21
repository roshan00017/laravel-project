<?php

namespace App\Http\Controllers\FrontEnd;

use App\Facades\NepaliDate;
use App\Helpers\FileUploadLibraryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\SuggestionRequest;
use App\Models\Grevience\Notification;
use App\Models\Grevience\Suggestion;
use App\Models\Grevience\SuggestionCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class SuggestionController extends Controller
{
    public function create()
    {

        try {

            $data['category'] = SuggestionCategory::all();
            $data['load_css'] = [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css',
            ];
            $data['load_js'] = [
                'js/frontendsuggestion.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js',
                'js/fileValidation.js',

            ];
            $data['script_js'] = "$(function(){
               $('#mobile').inputmask('9999999999', { placeholder: '' });
                $(document).ready(function () {
                    $('.type-select').niceSelect();
                });
                $(function () {
                $('#uploadToggler').click(function () {
                    $('#imageUploadInput').click();
                })
                })
            })";

            return view('frontend.suggestion.create', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(SuggestionRequest $request)
    {

        try {

            $data = $request->all();

            if ($request->hasfile('suggestion_file')) {

                $file = $request->file('suggestion_file');

                $maxSize = 1024;

                if ($file->getSize() > $maxSize * 1024) {
                    $errorMessage = trans('frontendSuggestion.suggestion.file_size_error');

                    return back()->withErrors(['suggestion_file' => $errorMessage])->withInput();

                }
                $data['files'] = FileUploadLibraryHelper::setFileUploadName($request->suggestion_file, $request->name);
                $imageSuccess = true;
            }
            $data['submit_date_np'] = NepaliDate::create(Carbon::now())->toBS();
            $data['submit_date_en'] = Carbon::now()->toDateString();
            $data['suggestion_month_code'] = (int) explode('-', $data['submit_date_np'])[1];
            $data['fy_id'] = currentFy()->id;
            $data['client_id'] = clientInfo()->id;

            DB::beginTransaction();
            if (isset($imageSuccess)) {
                FileUploadLibraryHelper::setFileUploadPath($request->suggestion_file, $data['files'], Suggestion::FILE_UPLOAD_PATH);
            }

            $create = Suggestion::create($data);

            // add notification logs
            $notificationData = [
                'fy_id' => $create->fy_id,
                'client_id' => $create->client_id,
                'notify_date_np' => $create->submit_date_np,
                'notify_date_en' => $create->submit_date_en,
                'title_en' => 'New suggestion register',
                'title_np' => 'नयाँ सुझाव दर्ता',
                'notify_url' => 'suggestions'.'/'.hashIdGenerate($create->id),
                'notify_type' => 'suggestion',
                'notify_id' => $create->id,
            ];

            Notification::create($notificationData);
            DB::commit();
            Session::flash('success', Lang::get('frontEndFlashMessage.suggestion_register_message'));

            return redirect()->route('frontEnd.dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
