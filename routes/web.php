<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

#frontend route
include_once 'frontEnd/index.php';
#auth route details
include_once 'authCommon.php';
#front end Appointment
include_once 'frontEnd/appointment.php';

#suchikrit user auth route details
include_once 'suchikritUser/auth.php';

#admin route details
Route::group(['middleware' => ['auth']], function () {

    #dashboard route details
    include_once 'admin/dashboard.php';

    #role management route details
    include_once 'admin/roles.php';

    #users management route details
    include_once 'admin/users.php';

    #logs management route details
    include_once 'admin/logs.php';

    #logs management route details
    include_once 'admin/masterSearch/mastersearch.php';

    #app setting route details
    include_once 'admin/systemSetting.php';
    include_once 'admin/edmis/dispatchBook.php';

    #basic route details
    Route::prefix('basicDetails')->group(function () {
        include_once 'admin/basicDetails/complaintSeverity.php';
        include_once 'admin/basicDetails/complaintSource.php';
        include_once 'admin/basicDetails/complaintType.php';
        include_once 'admin/basicDetails/dcMedium.php';
        include_once 'admin/basicDetails/dcStatus.php';
        include_once 'admin/basicDetails/mstDepartment.php';
        include_once 'admin/basicDetails/mstDocumentType.php';
        include_once 'admin/basicDetails/mstCountry.php';
        include_once 'admin/basicDetails/mstOffice.php';
        include_once 'admin/basicDetails/hrDesignation.php';
        include_once 'admin/basicDetails/suggestionCategory.php';
        include_once 'admin/basicDetails/faq.php';
        include_once 'admin/basicDetails/privacyPolicy.php';
        include_once 'admin/basicDetails/mstSetting.php';
        include_once 'admin/basicDetails/organizationTypes.php';
        include_once 'admin/basicDetails/bank.php';
        include_once 'admin/basicDetails/visitingPurpose.php';
        include_once 'admin/basicDetails/officialdetails.php';
        include_once 'admin/basicDetails/appointmentStatus.php';
    });

    #dcc route details
    include_once 'admin/dcc/serviceType.php';
    include_once 'admin/dcc/service.php';
    include_once 'admin/dcc/serviceRelatedDocument.php';
    include_once 'admin/dcc/serviceDepartment.php';
    include_once 'admin/dcc/serviceTokenList.php';
    include_once 'admin/dcc/serviceTokenLogDetails.php';

    #master setting data route details
    include_once 'admin/masterSettings/appClient.php';
    include_once 'admin/masterSettings/fiscalYear.php';
    include_once 'admin/masterSettings/setting.php';
    include_once 'admin/masterSettings/clientSetting.php';
    include_once 'admin/masterSettings/province.php';
    include_once 'admin/masterSettings/district.php';
    include_once 'admin/masterSettings/localBodyType.php';
    include_once 'admin/masterSettings/localBody.php';

    #edmis route details
    include_once 'admin/edmis/dcDocument.php';
    include_once 'admin/edmis/patraReport.php';
    include_once 'admin/edmis/dispatchBookReport.php';
    include_once 'admin/edmis/registerBookReport.php';
    include_once 'admin/edmis/registerBook.php';
    include_once 'admin/employees.php';
    include_once 'admin/edmis/dcDispatchBookStatusLog.php';
    include_once 'admin/edmis/dcRegisterBookStatusLog.php';
    include_once 'admin/edmis/memberType.php';
    include_once 'admin/edmis/standingListType.php';
    include_once 'admin/edmis/standingList.php';
    include_once 'admin/edmis/consumerCommittee.php';

    #meeting management route details
    include_once 'admin/meetings/meetings.php';
    include_once 'admin/meetings/meetingstatuses.php';
    include_once 'admin/meetings/meetingCategories.php';
    include_once 'admin/meetings/meetingLinkList.php';
    include_once 'admin/meetings/finalVerdictFile.php';
    include_once 'admin/meetings/karyapalikaMembers.php';

    # grevience system route
    include_once 'admin/grevience/suggestion.php';
    include_once 'admin/grevience/complaint.php';
    include_once 'admin/grevience/incidentReporting.php';
    include_once 'admin/grevience/notification.php';

    #add calendar management data
    include_once 'admin/calendar.php';

    #api setting data route details
    include_once 'admin/apiSetting/apiKey.php';
    include_once 'admin/apiSetting/apiAccessLog.php';

    #token management route details
    include_once 'admin/tokenManagement/tokenList.php';

    #voice call management  route details
    include_once 'admin/voiceCallManagement/voiceRecord.php';
    include_once 'admin/voiceCallManagement/phoneSmsManagement.php';

    #appointment
    include_once 'admin/appointment/appointment.php';
    include_once 'admin/appointment/dailyWorkingSchedule.php';
    include_once 'admin/appointment/scheduleType.php';

    #chat
    include_once 'admin/chat/chat.php';

    #call routing module

    include 'admin/callRouting/callRoutingNumberManagement.php';

});

#suchikrit user  route details
Route::group(['middleware' => ['auth:suchikritUser']], function () {

    #dashboard route details
});
include_once 'suchikritUser/dashboard.php';

#ajax route details
@require 'ajaxRoute.php';

#cache route details
Route::get('optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    $data['status'] = 202;
    $data['status_code'] = 202;
    $data['message'] = 'All cache Clear !!!';

    return response()->view('errors.exception', $data);
});
