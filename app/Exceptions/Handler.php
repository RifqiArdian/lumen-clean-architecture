<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  $request
     * @param Throwable $exception
     * @return Response|JsonResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(null,404);
        } else if ($exception instanceof MethodNotFoundException) {
            return response()->json(null,405);
        } else if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(null,405);
        } else if ($exception instanceof AuthorizationException) {
            if ($request->expectsJson()) {
                return response()->json(null,403);
            }
        } else if ($exception instanceof BadRequestHttpException) {
            return response()->json($exception->getMessage(),400);
        }
        return parent::render($request, $exception);
    }
}
