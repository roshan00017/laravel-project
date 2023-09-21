<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TokenManagement\Token;
use App\Models\TokenManagement\TokenLog;
use App\Repositories\API\CommonRepository;
use Illuminate\Http\Request;

class TokenManagementController extends Controller
{
    private CommonRepository $commonRepository;

    private Token $model;

    private TokenLog $tokeLogModel;

    public function __construct(CommonRepository $commonRepository, Token $model, TokenLog $tokeLogModel)
    {
        $this->commonRepository = $commonRepository;
        $this->model = $model;
        $this->tokeLogModel = $tokeLogModel;
    }

    public function generateToken(Request $request)
    {
        return $this->commonRepository->storeToken($this->model, $request);
    }

    public function updateTokenStatus(Request $request)
    {
        return $this->commonRepository->tokenStatusLog($this->tokeLogModel, $request);
    }
}
