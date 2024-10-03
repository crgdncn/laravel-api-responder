<?php /** @noinspection ALL */

namespace Flugg\Responder\Contracts\Resources;

use League\Fractal\Resource\ResourceInterface;

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
     * @param callable|\Flugg\Responder\Transformers\Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return \League\Fractal\Resource\ResourceInterface
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function make(mixed $data = null, callable|\Flugg\Responder\Transformers\Transformer|string $transformer = null, string $resourceKey = null): ResourceInterface;
}
