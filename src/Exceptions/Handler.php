<?php

namespace Flugg\Responder\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;

/**
 * An exception handler responsible for handling exceptions.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class Handler extends ExceptionHandler
{
    use ConvertsExceptions;

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception|\Throwable $exception
     * @return Response
     * @throws \Throwable
     * @throws \Throwable
     */
    public function render($request, $exception): Response
    {
        if ($request->wantsJson()) {
            $this->convertDefaultException($exception);

            if ($exception instanceof HttpException) {
                return $this->renderResponse($exception);
            }
        }

        return parent::render($request, $exception);
    }
}
