<?php

namespace App\Repositories;

use App\Models\Appointment\Appointment;
use App\Models\Appointment\AppointmentHandover;

class AppointmentRepository
{
    private Appointment $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function getAllAppointments($request)
    {
        if (getLan() == 'np') {
            $date = 'appointment_date_bs';
        } else {
            $date = 'appointment_date_ad';
        }
        $result = $this->appointment;
        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }

        if ($request->mobile_no != null) {
            $result = $result->where('mobile_no', $request->mobile_no);
        }
        if ($request->email != null) {
            $result = $result->where('email', $request->email);
        }
        if ($request->appointment_no != null) {
            $result = $result->where('appointment_no', $request->appointment_no);
        }

        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('appointment_date_ad', decrypt($request->today));
        }
        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($result);
        }
        //check appointment user module
        CommonRepository::appointUserModule($result, 'visiting_section', 'visiting_to_person_id');

        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getPersonalInfo($request)
    {
        $result = $this->appointment;

        if ($request->mobile_no != null) {
            $result = $result->where('mobile_no', $request->mobile_no);
        }
        if ($request->email != null) {
            $result = $result->where('email', $request->email);
        }
        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($result);
        }

        return $result->latest('id')->first();
    }

    public function getPersonalVisitLog($mobileNo = null, $email = null, $appointmentId = null, $request = null)
    {
        $result = $this->appointment;

        if ($request->mobile_no != null) {
            $result = $result->where('mobile_no', $request->mobile_no);
        }
        if ($request->email != null) {
            $result = $result->where('email', $request->email);
        }
        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($result);
        }

        return $result->where('id', '<>', $appointmentId)
            ->where('mobile_no', $mobileNo)
           // ->orWhere('email',$email)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getHandoverDetails($appointmentId = null, $request = null)
    {
        $result = AppointmentHandover::query();

        if ($request->mobile_no != null) {
            $result = $result->where('mobile_no', $request->mobile_no);
        }
        if ($request->email != null) {
            $result = $result->where('email', $request->email);
        }
        //        if (userInfo()->role_id > 2) {
        //            CommonRepository::checkClientId($result);
        //        }

        return $result->where('appointment_id', $appointmentId)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
}
