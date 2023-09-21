<?php

namespace App\Http\Middleware;

use App\Helpers\DateConverter;
use App\Models\ApiSetting\ApiKey;
use App\Models\ApiSetting\ApiKeyAccessEvent;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorizeApiKey
{
    const AUTH_HEADER = 'X-Authorization';

    private DateConverter $dateConverter;

    public function __construct(DateConverter $dateConverter)
    {
        $this->dateConverter = $dateConverter;
    }

    /**
     * Handle the incoming request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header(self::AUTH_HEADER);
        $apiKey = ApiKey::getByKey($header);

        if ($apiKey instanceof ApiKey) {
            $this->logAccessEvent($request, $apiKey);

            return $next($request);
        }

        return new JsonResponse([
            'status' => 401,
            'message' => 'Unauthorized',
        ], 401);
    }

    /**
     * Log an API key access event
     */
    protected function logAccessEvent(Request $request, ApiKey $apiKey)
    {
        $event = new ApiKeyAccessEvent();
        $event->api_key_id = $apiKey->id;
        $event->ip_address = $request->ip();
        $event->url = $request->fullUrl();
        $event->access_date = date('Y-m-d');
        $event->access_date_np = $this->dateConverter->eng_to_nep(date('Y-m-d'));

        $event->save();
    }
}
