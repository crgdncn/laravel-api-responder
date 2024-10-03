<?php

namespace Flugg\Responder\Contracts;

use Flugg\Responder\Http\Responses\ErrorResponseBuilder;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Flugg\Responder\Transformers\Transformer;

/**
 * A contract for responding with error- and success responses.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface Responder
{
    /**
     * Build a successful response.
     *
     * @param mixed|null $data
     * @param callable|Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return SuccessResponseBuilder
     */
    public function success(mixed $data = null, callable|Transformer|string $transformer = null, string $resourceKey = null): SuccessResponseBuilder;

    /**
     * Build an error response.
     *
     * @param mixed|null $errorCode
     * @param  string|null $message
     * @return \Flugg\Responder\Http\Responses\ErrorResponseBuilder
     */
    public function error(mixed $errorCode = null, string $message = null): ErrorResponseBuilder;
}
