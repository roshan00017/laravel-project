<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApiSetting\ApiKey;
use App\Repositories\API\CommonRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    private CommonRepository $commonRepository;

    private ApiKey $model;

    public function __construct(CommonRepository $commonRepository, ApiKey $model)
    {
        $this->commonRepository = $commonRepository;
        $this->model = $model;
    }

    public function getApiList(): object
    {
        return $this->commonRepository->getAllApiList($this->model);
    }

    public function getApiKey($name)
    {
        $name = Str::lower($name);

        return $this->commonRepository->getApiKey($this->model, $name);
    }

    public function storeApiKey(Request $request)
    {
        return $this->commonRepository->apiKeyRegister($this->model, $request);
    }
}
