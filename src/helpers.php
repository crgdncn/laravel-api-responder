<?php

use Flugg\Responder\Contracts\Responder;
use Flugg\Responder\Transformation;
use Flugg\Responder\TransformBuilder;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Contracts\Container\BindingResolutionException;

if (! function_exists('responder')) {

    /**
     * A helper method to resolve the responder service out of the service container.
     *
     * @return Responder
     */
    function responder(): Responder
    {
        return app(Responder::class);
    }
}

if (! function_exists('transformation')) {

    /**
     * A helper method to transform data without serializing.
     *
     * @param mixed|null $data
     * @param callable|Transformer|string|null $transformer
     * @return TransformBuilder
     * @throws BindingResolutionException
     */
    function transformation(mixed $data = null, callable|Transformer|string $transformer = null): TransformBuilder
    {
        return app(Transformation::class)->make($data, $transformer);
    }
}
