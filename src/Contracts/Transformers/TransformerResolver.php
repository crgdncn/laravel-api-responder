<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace Flugg\Responder\Contracts\Transformers;

use Flugg\Responder\Exceptions\InvalidTransformerException;
use Flugg\Responder\Transformers\Transformer;

/**
 * A contract for resolving transformers.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface TransformerResolver
{
    /**
     * Register a transformable to transformer binding.
     *
     * @param array|string $transformable
     * @param callback|string $transformer
     * @return void
     */
    public function bind(array|string $transformable, callable|string $transformer): void;

    /**
     * Resolve a transformer.
     *
     * @param callable|Transformer|string $transformer
     * @return Transformer|callable
     * @throws InvalidTransformerException
     */
    public function resolve(callable|Transformer|string $transformer): callable|Transformer;

    /**
     * Resolve a transformer from the given data.
     *
     * @param  mixed $data
     * @return Transformer|callable
     */
    public function resolveFromData(mixed $data): callable|Transformer;
}
