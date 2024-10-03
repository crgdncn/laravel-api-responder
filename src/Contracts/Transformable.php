<?php

namespace Flugg\Responder\Contracts;

/**
 * A contract for making the class transformable.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface Transformable
{
    /**
     * Get a transformer for the class.
     *
     * @return \Flugg\Responder\Transformers\Transformer|callable|string|null
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function transformer(): callable|\Flugg\Responder\Transformers\Transformer|string|null;
}
