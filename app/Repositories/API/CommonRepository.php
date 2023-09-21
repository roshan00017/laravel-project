<?php

namespace App\Repositories\API;

use App\Facades\NepaliDate;
use App\Helpers\TokenHelper;
use App\Models\ApiSetting\ApiAccessSetting;
use App\Models\ApiSetting\ApiKey;
use App\Models\TokenManagement\Token;
use App\SInterFace\API\CommonRepoInterFace;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class CommonRepository extends BaseRepository implements CommonRepoInterFace
{
    public function getAllData($model, $orderByColumnName, $orderBy, $selectColumns, $pageLimit = null): object
    {
        try {
            $query = $model->where('status', true)
                ->select($selectColumns)
                ->orderBy($orderByColumnName, $orderBy);
            if (is_null($pageLimit)) {
                $data = $query->get();
            } else {
                $data = $query->paginate($pageLimit);
            }
            if ($data->count() == 0) {
                $status = 400;
                $success = false;
                $message = 'No data Found.';
                $count = null;
            } else {
                $status = 200;
                $success = true;
                $message = 'Data successfully fetched';
                $count = $pageLimit ? $data->total() : $data->count();
            }

            return $this->apiJsonResponse($status, $success, $message, $data, $count);
        } catch (Throwable $th) {
            return $this->apiJsonResponse(500, false, 'Oops something went to wrong.', []);
        }
    }

    public function getAllApiList($model): object
    {
        try {
            $data = $model->where('status', true)
                ->select('name', 'key', 'status')
                ->get();

            if ($data->count() == 0) {
                $status = 400;
                $success = false;
                $message = 'No data Found.';
                $count = null;
            } else {
                $status = 200;
                $success = true;
                $message = 'Data successfully fetched';
                $count = $data->count();
            }

            return $this->apiJsonResponse($status, $success, $message, $data, $count);
        } catch (Throwable $th) {
            return $this->apiJsonResponse(500, false, 'Oops something went to wrong.', []);
        }
    }

    public function getApiKey($model, $name): object
    {
        try {
            $data = $model->where('status', true)
                ->where('name', $name)
                ->select('name as app_name', 'key as api_access_key')
                ->first();

            if (is_null($data)) {
                $status = 400;
                $success = false;
                $message = 'No data Found.';
            } else {
                ApiKey::where('name', $data->app_name)->update(['last_access_time' => Carbon::now()]);
                $status = 200;
                $success = true;
                $message = 'Data successfully fetched';
            }

            return $this->apiJsonResponse($status, $success, $message, $data);
        } catch (Throwable $th) {
            return $this->apiJsonResponse(500, false, $th->getMessage(), []);
        }
    }

    public function apiKeyRegister($model, $request)
    {
        $validator = Validator::make(request()->all(), [
            'app_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            DB::beginTransaction();
            $data['name'] = Str::lower($request->app_name);
            //check exist ap name
            $app_name = ApiKey::where('name', $data['name'])->first();
            if ($app_name) {
                $status = 200;
                $success = false;
                $message = 'This app  already registered. Please try another name';

                return $this->apiJsonResponse($status, $success, $message, []);
            }
            $data['key'] = ApiKey::generate();
            $create = $model->create($data);
            DB::commit();
            $status = 200;
            $success = true;
            $message = 'Api key  successfully registered';

            return $this->apiJsonResponse($status, $success, $message, ['app_name :'.' '.$create->name, 'api_key :'.' '.$create->key]);
        } catch (Exception $e) {
            DB::rollback();

            return $this->apiJsonResponse(500, false, 'Oops something went to wrong.', []);
        }
    }

    public function getApiAccessSetting($type): object
    {
        try {
            $data = ApiAccessSetting::query()
                ->select('base_url as baseUrl')
                ->where('type', $type)
                ->first();
            if ($data->count() == 0) {
                $status = 400;
                $success = false;
                $message = 'No data Found.';
                $count = null;
            } else {
                $status = 200;
                $success = true;
                $message = 'Data successfully fetched';
                $count = $data->count();
            }

            return $this->apiJsonResponse($status, $success, $message, $data, $count);
        } catch (Throwable $th) {
            return $this->apiJsonResponse(500, false, 'Oops something went to wrong.', []);
        }
    }

    public function storeToken($model, $request)
    {
        $validator = Validator::make(request()->all(), [
            'module_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            DB::beginTransaction();
            $data = [
                'client_id' => $request->client_id,
                'module_name' => 'dcc',
                'module_service_name' => Str::lower($request->module_name),
                'status_title_np' => $request->status_title_np,
                'status_title_en' => $request->status_title_en,
                'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'date_en' => Carbon::now()->toDateString(),
                'token_no' => TokenHelper::generateUniqueTokenNo($request->client_id, $request->module_name),
            ];
            $create = $model->create($data);
            DB::commit();
            $status = 200;
            $success = true;
            $message = 'Token   successfully generated';

            return $this->apiJsonResponse($status, $success, $message, ['tokenNo' => $create->token_no]);
        } catch (Exception $e) {
            DB::rollback();

            return $this->apiJsonResponse(500, false, 'Oops something went to wrong.', []);
        }
    }

    public function tokenStatusLog($model, $request)
    {
        $validator = Validator::make(request()->all(), [
            'tokenNo' => 'required',
            'module_status_id' => 'required',
            'module_unique_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
                'status' => Response::HTTP_BAD_REQUEST,
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            //check toke exist
            $value = Token::query()->where('token_no', $request->tokenNo)->first();
            if ($value) {

                DB::beginTransaction();
                //update latest status in token table

                $tokenData = [
                    'module_status_id' => $request->module_status_id,
                    'module_unique_id' => $request->module_unique_id,
                    'status_title_np' => $request->status_title_np,
                    'status_title_en' => $request->status_title_en,
                    'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'date_en' => Carbon::now()->toDateString(),
                ];
                Token::query()->where('token_no', $request->tokenNo)->update($tokenData);

                $data = [
                    'module_status_id' => $request->module_status_id,
                    'status_title_np' => $request->status_title_np,
                    'status_title_en' => $request->status_title_en,
                    'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'date_en' => Carbon::now()->toDateString(),
                    'token_no' => $request->tokenNo,
                ];
                $create = $model->create($data);
                DB::commit();
                $status = 200;
                $success = true;
                $message = 'Token   status  successfully updated';

                return $this->apiJsonResponse($status, $success, $message, ['tokenNo' => $create->token_no, 'status' => $create->module_status_id]);

            } else {
                return $this->apiJsonResponse(404, false, 'Token not found in our record', []);
            }

        } catch (Exception $e) {
            dd($e);
            DB::rollback();

            return $this->apiJsonResponse(500, false, 'Oops something went to wrong.', []);
        }
    }
}
