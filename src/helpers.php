<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */

/** @noinspection PhpFullyQualifiedNameUsageInspection */

use Flugg\Responder\Contracts\Responder;
use Flugg\Responder\Transformation;
use Flugg\Responder\TransformBuilder;

if (! function_exists('responder')) {

    /**
     * A helper method to resolve the responder service out of the service container.
     *
     * @return \Flugg\Responder\Contracts\Responder
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
     * @param callable|\Flugg\Responder\Transformers\Transformer|string|null $transformer
     * @return \Flugg\Responder\TransformBuilder
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function transformation(mixed $data = null, callable|\Flugg\Responder\Transformers\Transformer|string $transformer = null): TransformBuilder
    {
        return app(Transformation::class)->make($data, $transformer);
    }
}
