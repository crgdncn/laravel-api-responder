<?php

namespace Flugg\Responder\Contracts;

use Flugg\Responder\TransformBuilder;
use Flugg\Responder\Transformers\Transformer;

/**
 * A contract for transforming data, without the serializing.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface SimpleTransformer
{
    /**
     * Transform the data without serializing, using the given transformer.
     *
     * @param mixed|null $data
     * @param callable|Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return \Flugg\Responder\TransformBuilder
     */
    public function make(mixed $data = null, callable|Transformer|string $transformer = null, string $resourceKey = null): TransformBuilder;
}
