<?php

namespace Flugg\Responder\Exceptions\Http;

/**
 * An exception thrown when a page is not found.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class PageNotFoundException extends HttpException
{
    /**
     * An HTTP status code.
     *
     * @var int
     */
    protected int $status = 404;

    /**
     * An error code.
     *
     * @var string|null
     */
    protected ?string $errorCode = 'page_not_found';
}
