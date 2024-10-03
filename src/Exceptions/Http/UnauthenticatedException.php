<?php

namespace Flugg\Responder\Exceptions\Http;

/**
 * An exception thrown when a user is unauthenticated. This exception replaces Laravels'
 * [\Illuminate\Auth\AuthenticationException].
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class UnauthenticatedException extends HttpException
{
    /**
     * An HTTP status code.
     *
     * @var int
     */
    protected int $status = 401;

    /**
     * The error code.
     *
     * @var string|null
     */
    protected ?string $errorCode = 'unauthenticated';
}
