<?php

namespace Flugg\Responder\Exceptions\Http;

/**
 * An exception thrown when a relation is not found.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class RelationNotFoundException extends HttpException
{
    /**
     * An HTTP status code.
     *
     * @var int
     */
    protected int $status = 422;

    /**
     * An error code.
     *
     * @var string|null
     */
    protected ?string $errorCode = 'relation_not_found';
}
