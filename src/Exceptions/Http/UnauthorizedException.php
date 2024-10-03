<?php

namespace Flugg\Responder\Exceptions\Http;

/**
 * An exception thrown when a user is unauthorized. This exception replaces Laravels'
 * [\Illuminate\Auth\Access\AuthorizationException].
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class UnauthorizedException extends HttpException
{
    /**
     * An HTTP status code.
     *
     * @var int
     */
    protected int $status = 403;

    /**
     * An error code.
     *
     * @var string|null
     */
    protected ?string $errorCode = 'unauthorized';
}
