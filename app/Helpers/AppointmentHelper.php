<?php

namespace App\Helpers;

use App\Models\BasicDetails\ElectedPerson;
use App\Models\BasicDetails\VisitingPurpose;
use App\Models\EDMIS\Employee;
use Illuminate\Support\Facades\DB;

class AppointmentHelper
{
    public static function getVisitingPurpose($id)
    {
        $purpose = VisitingPurpose::where('id', $id)
            ->first();
        if ($purpose) {
            return getLan() == 'np' ? $purpose->name_np : $purpose->name_en;
        }
    }

    public static function getEmployee($id)
    {

        $employee = Employee::where('id', $id)
            ->first();
        if ($employee) {
            return getLan() == 'np' ? $employee->first_name_np.' '.$employee->middle_name_np.' '.$employee->last_name_np : $employee->first_name_en.' '.$employee->middle_name_en.' '.$employee->last_name_en;
        }
    }

    public static function getElectedPerson($id)
    {
        $person = ElectedPerson::where('id', $id)
            ->first();
        if ($person) {
            return getLan() == 'np' ? $person->name_np : $person->name_en;
        }
    }

    public static function getElectedPersonByDesId($id)
    {
        $name = setName();

        return ElectedPerson::where('hr_designation_id', $id)
            ->get()->pluck($name, 'id');
    }

    public static function getEmployeeByDesId($id)
    {
        $name = setName();

        return Employee::where('hr_designation_id', $id)
            ->select('id', DB::raw("CONCAT(first_name_np,' ',middle_name_np,' ',last_name_np) AS full_name"))
            ->get()->pluck('full_name', 'id');
    }
}
