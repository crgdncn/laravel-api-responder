<?php

namespace Flugg\Responder;

use Flugg\Responder\Contracts\Responder as ResponderContract;
use Flugg\Responder\Http\Responses\ErrorResponseBuilder;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Flugg\Responder\Transformers\Transformer;

/**
 * A service class responsible for building responses.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class Responder implements ResponderContract
{
    /**
     * A builder for building success responses.
     *
     * @var SuccessResponseBuilder
     */
    protected $successResponseBuilder;

    /**
     * A builder for building error responses.
     *
     * @var ErrorResponseBuilder
     */
    protected $errorResponseBuilder;

    /**
     * Construct the service class.
     *
     * @param SuccessResponseBuilder $successResponseBuilder
     * @param ErrorResponseBuilder $errorResponseBuilder
     */
    public function __construct(SuccessResponseBuilder $successResponseBuilder, ErrorResponseBuilder $errorResponseBuilder)
    {
        $this->successResponseBuilder = $successResponseBuilder;
        $this->errorResponseBuilder = $errorResponseBuilder;
    }

    /**
     * Build a successful response.
     *
     * @param mixed|null $data
     * @param callable|Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return SuccessResponseBuilder
     */
    public function success(mixed $data = null, callable|Transformer|string $transformer = null, string $resourceKey = null): SuccessResponseBuilder
    {
        return $this->successResponseBuilder->transform($data, $transformer, $resourceKey);
    }

    /**
     * Build an error response.
     *
     * @param mixed|null $errorCode
     * @param  string|null $message
     * @return ErrorResponseBuilder
     */
    public function error(mixed $errorCode = null, string $message = null): ErrorResponseBuilder
    {
        return $this->errorResponseBuilder->error($errorCode, $message);
    }
}
