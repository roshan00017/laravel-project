<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\BasicDetails\ElectedPerson;
use App\Models\EDMIS\Employee;
use App\Models\EDMIS\SuchikritUser;
use App\Models\Meetings\KaryapalikaMember;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingAgendaList;
use App\Models\Meetings\MeetingMember;
use App\Models\SystemSetting\SmsSetting;
use App\Models\User;
use Exception;
use Harmoniemedia\SimpleLaravelJitsi\SimpleLaravelJitsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class CommonController extends Controller
{
    public function check_login_user_name()
    {
        try {
            $login_user_name = Str::lower($_POST['login_user_name']);
            $user = User::where('login_user_name', '=', $login_user_name)->count();
            if ($user > 0) {
                return response()->json([
                    'status' => true,
                    'message' => Lang::get('message.flash_messages.this_user_name_already_exist'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function check_email()
    {
        try {
            $email = Str::lower($_POST['email']);
            $user = User::where('email', '=', $email)->count();
            if ($user > 0) {
                return response()->json([
                    'status' => true,
                    'message' => Lang::get('message.flash_messages.this_email_address_already_exist'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function check_mobile()
    {
        try {
            $mobile = Str::lower($_POST['mobile']);
            $user_type = Str::lower($_POST['login_user_type']);
            $user = User::where('mobile_no', '=', $mobile)->count();
            if ($user > 0) {
                return response()->json([
                    'status' => true,
                    'message' => Lang::get('message.flash_messages.this_contact_already_exist'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function checkClientSmsSetting()
    {
        try {
            $client_id = $_POST['client_id'];
            $user = SmsSetting::where('client_id', '=', $client_id)->count();
            if ($user > 0) {
                return response()->json([
                    'status' => true,
                    'message' => Lang::get('common.client_exist'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function generateMetingUrl()
    {
        try {
            if (userInfo()->client_id != null) {
                $clientInfo = clientInfo(userInfo()->client_id);

                $roomName = $clientInfo->code.rand_string(10);
            } else {
                $roomName = 'soms'.rand_string(10);
            }
            $meeting_room_url = (new SimpleLaravelJitsi())->create_meeting_room_url($roomName);

            return response()->json([
                'status' => true,
                'data' => $meeting_room_url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function getAgendaByMeeting()
    {
        try {
            $meeting_id = $_POST['meeting_id'];
            $agendaList = '';

            if ($meeting_id) {
                $agendaList = MeetingAgendaList::query()->where('meeting_id', $meeting_id)->orderBy('id', 'DESC')->get();
            }
            $result = "<option class='f-kalimati' value=''>".trans('meeting.final_verdict.select_agenda').'</option>';
            foreach ($agendaList as $value) {
                $result .= "<option class='f-kalimati' value='".$value->id."'>".$value->title.'</option>';
            }
            $members = '';
            if ($meeting_id) {
                $members = MeetingMember::query()->where('meeting_id', $meeting_id)->orderBy('id', 'DESC')->get();

            }
            $result1 = "<option class='f-kalimati' value=''>".trans('meeting.final_verdict.select_member').'</option>';
            foreach ($members as $value) {
                $result1 .= "<option class='f-kalimati' value='".$value->id."'>".$value->name_en.'</option>';
            }

            return ['result' => $result, 'result1' => $result1];
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function getMeetingAgenda()
    {
        try {
            $meeting_id = $_POST['meeting_id'];
            $agendaList = '';

            if ($meeting_id) {
                $agendaList = MeetingAgendaList::query()->where('meeting_id', $meeting_id)->orderBy('id', 'DESC')->get();
                $members = MeetingMember::query()->where('meeting_id', $meeting_id)->orderBy('id', 'DESC')->get();
            }
            $result1 = "<option class='f-kalimati' value=''>".trans('meeting.final_verdict.select_member').'</option>';
            foreach ($members as $value) {
                $result1 .= "<option class='f-kalimati' value='".$value->id."'>".$value->name_en.'</option>';
            }

            $result = '<div class="col-md-12">';
            foreach ($agendaList as $value) {
                $result .= "<div  class='col-md-6' style='float:left;'>";
                $result .= '<div><label>'.$value->title.'</label></div>';

                $result .= "<table id='ajendaFeedback_".$value->id."'>";
                $result .= "<tr id='cloneFeedback_".$value->id."' style='display:none;'>
            <td>
            <select class='form-control col-md-8' name='member_id[$value->id][]'>
                $result1
            </select>
            </td>
            <td><textarea class='col-md-10' name='feedback[$value->id][]'></textarea></td>
            <td><a href='#' class='btn btn-danger removefed' data-id='$value->id'> मेटाउने? </a></td>
            </tr>";
                $result .= " <tr>
            <th class='col-md-6'>सदस्यहरू</th>
            <th class='col-md-6'>प्रतिक्रिया</th>
            <th></th>
            </tr>
            <tr>
            <td>
            <select class='form-control col-md-8' name='member_id[$value->id][]'>
                $result1
            </select>
            </td>
            <td><textarea class='col-md-10' name='feedback[$value->id][]'></textarea></td>
            <td><a href='#'  class='btn btn-primary addMore' data-id='$value->id'> थप्नुहोस्</a></td>
            </tr>
            </table>";
                $result .= '</div>';

            }
            $result .= '</div>';

            return ['result' => $result];
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }

    }

    public function getMeetingKarpalikaMember()
    {
        try {
            $meeting_id = $_POST['meeting_id'];

            $meetingInfo = Meeting::query()->where('id', $meeting_id)->first();

            if ($meeting_id) {
                if ($meetingInfo->meeting_category_id == 2) {

                    // $members = KaryapalikaMember::query()->where('client_id', clientInfo()->client_id)->orderBy('id', 'DESC')->get();
                    $members = KaryapalikaMember::query()->orderBy('id', 'DESC')->get();

                    $result = "<option class='f-kalimati' value=''>".trans('meeting.final_verdict.select_member').'</option>';
                    foreach ($members as $value) {
                        $result .= "<option class='f-kalimati' value='".$value->id."'>".$value->name_en.'</option>';
                    }

                    return $result;

                }
            } else {
                return response()->json([
                    'success' => false,
                    'data' => [],
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }

    }

    public function getEmployee(Request $request): string
    {
        try {
            $emp_designation_id = $request->emp_designation;
            $empList = Employee::query()
                ->select('id', 'first_name_np', 'middle_name_np', 'last_name_np', 'first_name_en', 'middle_name_en', 'last_name_en')
                ->where('hr_designation_id', $emp_designation_id)
                ->orderBy('id', 'desc')
                ->get();
            $result = "<option  value=''>".trans('appointment.select_employee').'</option>';
            foreach ($empList as $value) {
                $fullName = getLan() == 'np' ? $value->first_name_np.' '.$value->middle_name_np.' '.$value->last_name_np : $value->first_name_en.' '.$value->middle_name_en.' '.$value->last_name_en;
                $result .= "<option  value='".$value->id."'>".$fullName.'</option>';
            }

            return $result;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }

    }

    public function getElectedPerson(Request $request): string
    {
        try {
            $name = setName();
            $elected_designation = $request->elected_designation;
            $empList = ElectedPerson::query()
                ->select('id', $name)
                ->where('hr_designation_id', $elected_designation)
                ->orderBy('id', 'desc')
                ->get();
            $result = "<option  value=''>".trans('appointment.select_elected_person').'</option>';
            foreach ($empList as $value) {
                $result .= "<option  value='".$value->id."'>".$value->$name.'</option>';
            }

            return $result;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }

    }

    public function checkSuchitkritEmail()
    {
        try {
            $email = Str::lower($_POST['email']);
            $user = SuchikritUser::where('email', '=', $email)->count();
            if ($user > 0) {
                return response()->json([
                    'status' => true,
                    'message' => Lang::get('message.flash_messages.this_email_address_already_exist'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function checkSuchitkritMobile()
    {
        try {
            $mobile = Str::lower($_POST['mobile']);
            $user = SuchikritUser::where('mobile_no', '=', $mobile)->count();
            if ($user > 0) {
                return response()->json([
                    'status' => true,
                    'message' => Lang::get('message.flash_messages.this_contact_already_exist'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function checkAppointmentEmail()
    {
        try {
            $email = Str::lower($_POST['email']);
            $user = Appointment::where('email', '=', $email)->select('full_name as name', 'mobile_no as mobile', 'email', 'address')->first();
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => Lang::get('message.flash_messages.dataNotFoundMessage'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function checkAppointmentMobile()
    {
        try {
            $mobile = Str::lower($_POST['mobile']);
            $user = Appointment::where('mobile_no', '=', $mobile)->select('full_name as name', 'mobile_no as mobile', 'email', 'address')->first();
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => Lang::get('message.flash_messages.dataNotFoundMessage'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function memberDetails(Request $request): string
    {
        try {
            $meeting_id = $request->meeting_id;
            $meeting_id = Meeting::where('id', '=', $meeting_id)->first();
            if ($meeting_id) {
                return response()->json([
                    'status' => true,
                    'message' => $meeting_id,
                ], 200)->getContent();
            } else {
                return response()->json([
                    'status' => false,
                    'message' => Lang::get('message.flash_messages.dataNotFoundMessage'),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function check_otp(Request $request)
    {
        try {
            $checkInfo = SuchikritUser::where('otp_code', '=', $request->otp_code)->first();
            if (is_null($checkInfo)) {
                return response()->json([
                    'status' => true,
                    'message' =>   getLan() ? 'Opt Code रेकर्ड सग मेल खाएन':'Otp code does not exist !',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }
}
