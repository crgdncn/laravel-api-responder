<?php

namespace Flugg\Responder\Exceptions\Http;

use Illuminate\Contracts\Validation\Validator;

/**
 * An exception thrown when validation fails. This exception replaces Laravel
 * [\Illuminate\Validation\ValidationException].
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class ValidationFailedException extends HttpException
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
    protected ?string $errorCode = 'validation_failed';

    /**
     * A validator for fetching validation messages.
     *
     * @var Validator
     */
    protected $validator;

    /**
     * Construct the exception class.
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;

        parent::__construct();
    }

    /**
     * Retrieve the error data.
     *
     * @return array|null
     */
    public function data(): ?array
    {
        return ['fields' => $this->validator->getMessageBag()->toArray()];
    }
}
