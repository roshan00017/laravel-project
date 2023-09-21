<?php

namespace App\Helpers;

use App\Models\BasicDetails\FormCategory;
use App\Models\BasicDetails\MstOffice;
use App\Models\BasicDetails\SeverityType;
use Exception;

class ComplaintHelper
{
    public static function getSeverityType($id)
    {
        $severityName = SeverityType::select('name_ne')->where('id', $id)
            ->first();
        if ($severityName) {
            return $severityName->name_ne;
        }
    }

    public static function compalintCategorty($id)
    {
        $severityName = FormCategory::select('name_ne')->where('id', $id)
            ->first();
        if ($severityName) {
            return $severityName->name_ne;
        }
    }

    public static function getOffice($id)
    {
        $office = MstOffice::select('name_ne')->where('id', $id)
            ->first();
        if ($office) {
            return $office->name_ne;
        }
    }

    // sparrow sms
    public function sendSMS($mobile, $message)
    {
        try {

        } catch (Exception $e) {
        }
    }
}
