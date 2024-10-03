<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace Flugg\Responder\Contracts\Transformers;

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
     * @param callable|\Flugg\Responder\Transformers\Transformer|string $transformer
     * @return \Flugg\Responder\Transformers\Transformer|callable
     * @throws \Flugg\Responder\Exceptions\InvalidTransformerException
     */
    public function resolve(callable|\Flugg\Responder\Transformers\Transformer|string $transformer): callable|\Flugg\Responder\Transformers\Transformer;

    /**
     * Resolve a transformer from the given data.
     *
     * @param  mixed $data
     * @return \Flugg\Responder\Transformers\Transformer|callable
     */
    public function resolveFromData(mixed $data): callable|\Flugg\Responder\Transformers\Transformer;
}
