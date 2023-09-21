<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\BasicDetails\PrivacyPolicy;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        try {
            $policy = PrivacyPolicy::all();

            return view('frontend.faq.privacy_policy', compact('policy'));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
