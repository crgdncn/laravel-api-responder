<?php /** @noinspection ALL */

/** @noinspection ALL */

namespace Flugg\Responder\Contracts;

use Flugg\Responder\Http\Responses\ErrorResponseBuilder;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;

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
     * @param callable|\Flugg\Responder\Transformers\Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function success(mixed $data = null, callable|\Flugg\Responder\Transformers\Transformer|string $transformer = null, string $resourceKey = null): SuccessResponseBuilder;

    /**
     * Build an error response.
     *
     * @param mixed|null $errorCode
     * @param  string|null $message
     * @return \Flugg\Responder\Http\Responses\ErrorResponseBuilder
     */
    public function error(mixed $errorCode = null, string $message = null): ErrorResponseBuilder;
}
