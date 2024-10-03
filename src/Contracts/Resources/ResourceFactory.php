<?php

namespace Flugg\Responder\Contracts\Resources;

use League\Fractal\Resource\ResourceInterface;
use Flugg\Responder\Transformers\Transformer;

/**
 * A contract for creating resources.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface ResourceFactory
{
    /**
     * Make resource from the given data.
     *
     * @param mixed|null $data
     * @param callable|Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return ResourceInterface
     */
    public function make(mixed $data = null, callable|Transformer|string $transformer = null, string $resourceKey = null): ResourceInterface;
}
