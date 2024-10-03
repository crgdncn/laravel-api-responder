<?php

namespace Flugg\Responder\Contracts;

use Flugg\Responder\Transformers\Transformer;

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
     * @return Transformer|callable|string|null
     */
    public function transformer(): callable|Transformer|string|null;
}
