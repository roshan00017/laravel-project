<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Lang;
use PDOException;
use Psr\Log\LogLevel;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        $url = $request->url();

        $loweredCaseUrl = strtolower($url);
        if (
            $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException &&
            $url !== $loweredCaseUrl
        ) {
            return redirect($loweredCaseUrl);
        }
        // dd($exception);
        if ($this->isHttpException($exception)) {
            if (! method_exists($exception, 'getStatusCode') || ! $request->wantsJson()) {
                $status = $exception->getStatusCode();
                if ($status == 401) {
                    return response()->view('errors.401', [], 401);
                } elseif ($status == 404) {
                    return response()->view('errors.404', [], 404);
                } elseif ($status == 405) {
                    $data['status'] = 405;
                    $data['status_code'] = 405;
                    $data['message'] = 'Method Not allowed';

                    return response()->view('errors.exception', $data);
                }
            }
        }
        if ($exception instanceof MethodNotAllowedException) {
            $data['status'] = 405;
            $data['status_code'] = 405;
            $data['message'] = 'Method Not allowed';

            return response()->view('errors.exception', $data);
        }
        if ($exception instanceof PDOException) {

            //db message
            //$data['message'] = $exception->getMessage();
            $data['status'] = 505;
            $data['status_code'] = 505;
            $data['message'] = Lang::get('message.commons.technicalError');

            return response()->view('errors.exception', $data);
        }
        //check token mismatch status 419
        if ($exception instanceof TokenMismatchException) {
            $data['status'] = 419;
            $data['status_code'] = 419;
            $data['message'] = getLan() == 'np' ? 'माफ गर्नुहोस्  सेसन  समयअवधि  सकिएकाले  तपाईको अनुरोध सफल हुन सकेन ।कृपया: पुन प्रयास गर्नुहोला ।' : 'Sorry, your request was not successful because the session timed out. Please: try again';

            return response()->view('errors.exception', $data);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  Request  $request
     * @return Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
