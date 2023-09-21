<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\BasicDetails\Faq;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function index()
    {
        try {
            $faqs = Faq::all();

            return view('frontend.faq.index', compact('faqs'));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
