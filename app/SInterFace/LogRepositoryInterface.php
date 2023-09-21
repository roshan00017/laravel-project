<?php

namespace App\SInterFace;

interface LogRepositoryInterface
{
    public function getAllLoginLog($request);

    public function getAllLoginFails($request);

    public function getAllActionLogs($request);

    public function moduleList();
}
