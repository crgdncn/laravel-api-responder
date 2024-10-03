<?php /** @noinspection ALL */

namespace Flugg\Responder\Contracts;

use Flugg\Responder\TransformBuilder;

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
     * @param callable|\Flugg\Responder\Transformers\Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return \Flugg\Responder\TransformBuilder
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function make(mixed $data = null, callable|\Flugg\Responder\Transformers\Transformer|string $transformer = null, string $resourceKey = null): TransformBuilder;
}
