<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $ex) {
            DB::rollBack();
            if ($ex instanceof ModelNotFoundException) {
                return errorResponse(404, $ex->getMessage());
            };

            if ($ex instanceof NotFoundHttpException) {
                return errorResponse(404, $ex->getMessage());
            }

            if ($ex instanceof MethodNotAllowedHttpException) {
                return errorResponse(500, $ex->getMessage());
            }

            if ($ex instanceof Exception) {
                return errorResponse(500, $ex->getMessage());
            }

            if ($ex instanceof Error) {
                return errorResponse(500, $ex->getMessage());
            }

            if ($ex instanceof QueryException) {
                return errorResponse(500, $ex->getMessage());
            }

            if (config('app.debug')) {
                return errorResponse(500, $ex->getMessage());
            }

            return $this->errorResponse($ex->getMessage(), 500);
        });
    })->create();
