<?php

use App\Http\Controllers\Ajax\CommonController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\PhoneSmsApiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Grevience\DropDownController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Meetings\MeetingMemberController;
use Illuminate\Support\Facades\Route;

Route::get('reload-captcha', [LoginController::class, 'reloadCaptcha']);

Route::post('check_identity', [LoginController::class, 'checkIdentity'])
    ->name('check_identity');

Route::post('check_login_user_name', [CommonController::class, 'check_login_user_name'])
    ->name('check_login_user_name');

Route::post('check_email', [CommonController::class, 'check_email'])
    ->name('check_email');

Route::post('check_mobile', [CommonController::class, 'check_mobile'])
    ->name('check_mobile');

Route::get('change/lang', [LocalizationController::class, 'langChange'])
    ->name('LangChange');

Route::post('check_client_sms_setting', [CommonController::class, 'checkClientSmsSetting'])
    ->name('checkClientSmsSetting');

Route::post('generateMeetingLink', [CommonController::class, 'generateMetingUrl'])
    ->name('generateMeetingLink');

Route::post('agendaListByMeeting', [CommonController::class, 'getAgendaByMeeting'])
    ->name('getAgendaByMeeting');

Route::post('meetingAgenda', [CommonController::class, 'getMeetingAgenda'])
    ->name('getMeetingAgenda');

Route::post('/app/get_province', [LocationController::class, 'getProvince'])
    ->name('get_province');

Route::post('/app/get_district', [LocationController::class, 'getDistrict'])
    ->name('get_district');

Route::post('/app/get_local_body', [LocationController::class, 'getLocalBody'])
    ->name('get_local_body');

Route::post('/app/get_is_copy_location_info', [LocationController::class, 'isCopyLocationInfo'])
    ->name('get_is_copy_location_info');

Route::post('/app/get_ward', [LocationController::class, 'getWard'])
    ->name('get_ward');

//Dependent DropDown
Route::get('location/zones', [DropDownController::class, 'getZone']);
Route::get('location/province', [DropDownController::class, 'getProvinceList']);
Route::get('location/zonaldistrict/{id}', [DropDownController::class, 'getzonaldistrict']);
Route::get('location/zonalvdc/{id}', [DropDownController::class, 'getzonalvdc']);

Route::get('/fed_district/{id}', [DropDownController::class, 'getfed_district']);
Route::get('/fed_vdc/{id}', [DropDownController::class, 'getfed_vdc']);
Route::post('/get_fed_district', [DropDownController::class, 'get_fed_district']);
Route::post('/get_fed_vdc_mun', [DropDownController::class, 'get_fed_vdc_mun']);

Route::post('/get_karyapalika_member_list', [CommonController::class, 'getMeetingKarpalikaMember']);

Route::post('/getEmpName', [CommonController::class, 'getEmployee'])
    ->name('getEmployee');

Route::post('/getElectedPerson', [CommonController::class, 'getElectedPerson'])
    ->name('getElectedPerson');

Route::post('checkEmail', [CommonController::class, 'checkSuchitkritEmail'])
    ->name('checkEmail');

Route::post('checkMobile', [CommonController::class, 'checkSuchitkritMobile'])
    ->name('checkMobile');

Route::post('checkAppointmentByEmail', [CommonController::class, 'checkAppointmentEmail'])
    ->name('checkAppointmentByEmail');

Route::post('checkAppointmentByMobile', [CommonController::class, 'checkAppointmentMobile'])
    ->name('checkAppointmentByMobile');

Route::post('getMeetingDetails', [CommonController::class, 'memberDetails'])
    ->name('getMeetingDetails');

//phone call sms campaign call

Route::post('addUpdateCampaign', [PhoneSmsApiController::class, 'addUpdateCampaign'])
    ->name('addUpdateCampaign');

Route::post('deleteCampaign', [PhoneSmsApiController::class, 'deleteCampaign'])
    ->name('deleteCampaign');

Route::post('addUpdateCampaignNumber', [PhoneSmsApiController::class, 'addUpdateCampaignNumber'])
    ->name('addUpdateCampaignNumber');

Route::post('deleteCampaignNumber', [PhoneSmsApiController::class, 'deleteCampaignNumber'])
    ->name('deleteCampaignNumber');



Route::post('check_otp', [CommonController::class, 'check_otp'])
    ->name('check_otp');


Route::post('updateMemberPresentStatus', [MeetingMemberController::class, 'updatePresentStatus'])
    ->name('updateMemberPresentStatus');

