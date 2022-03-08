<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(\Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return Response
     *
     * @throws Exception
     */
    public function render($request, \Throwable $exception)
    {
        if ($request->is('api*')) {
            if ($exception instanceof ValidationException) {
                return response([
                    'errors' => $exception->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($exception instanceof AuthorizationException) {
                return response([
                    'message' => $exception->getMessage()
                ], Response::HTTP_FORBIDDEN);
            }

            if ($exception instanceof ModelNotFoundException ||
                $exception instanceof NotFoundHttpException
            ) {
                return response([
                    'message' => '404 Not Found.'
                ], Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response([
                    'message' => $exception->getMessage()
                ], 401);
            }
            if ($exception instanceof QueryException) {
                return response([

                    'message' => $exception->getMessage()
                ], 401);
            }
            if ($exception instanceof ParseError) {
                return response([

                    'message' => $exception->getMessage()
                ], 401);
            }
            if ($exception instanceof BindingResolutionException) {
                return response([
                    'message' => $exception->getMessage()
                ], 401);
            }
            if ($exception instanceof \BadMethodCallException) {
                return response([
                    'message' => $exception->getMessage()
                ], 401);
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response([
                    'message' => $exception->getMessage()
                ], Response::HTTP_METHOD_NOT_ALLOWED);
            }
            if ($exception instanceof \ArgumentCountError) {
                return response([
                    'message' => 'Too few arguments to function'
                ], Response::HTTP_BAD_REQUEST);
            }
            if ($exception instanceof UnauthorizedHttpException) {
                return response([
                    'message' => $exception->getMessage()
                ], Response::HTTP_UNAUTHORIZED);
            }
            dd($exception);
            return response([
                'message' => 'Something Went Wrong'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $exception);
    }
}
