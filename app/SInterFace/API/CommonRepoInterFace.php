<?php

namespace App\SInterFace\API;

interface CommonRepoInterFace
{
    public function getAllData($model, $orderByColumnName, $orderBy, $selectColumns, $pageLimit);

    public function getApiKey($model, $name);

    public function getAllApiList($model);

    public function apiKeyRegister($model, $request);
}
