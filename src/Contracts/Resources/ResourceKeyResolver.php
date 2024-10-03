<?php

namespace Flugg\Responder\Contracts\Resources;

/**
 * A contract for resolving resource keys.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface ResourceKeyResolver
{
    /**
     * Register a transformable to resource key binding.
     *
     * @param array|string $transformable
     * @param  string       $resourceKey
     * @return void
     */
    public function bind(array|string $transformable, string $resourceKey): void;

    /**
     * Resolve a resource key from the given data.
     *
     * @param  mixed $data
     * @return string
     */
    public function resolve(mixed $data): string;
}
