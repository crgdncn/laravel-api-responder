<?php

namespace Flugg\Responder\Transformers;

use Flugg\Responder\Contracts\Transformable;
use Flugg\Responder\Contracts\Transformers\TransformerResolver as TransformerResolverContract;
use Flugg\Responder\Exceptions\InvalidTransformerException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Traversable;

/**
 * This class is responsible for resolving transformers.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class TransformerResolver implements TransformerResolverContract
{
    /**
     * Transformable to transformer mappings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * A container used to resolve transformers.
     *
     * @var Container
     */
    protected $container;

    /**
     * A fallback transformer to return when no transformer can be resolved.
     *
     * @var Transformer|string|callable
     */
    protected $fallback;

    /**
     * Construct the resolver class.
     *
     * @param Container $container
     * @param callable|Transformer|string $fallback
     */
    public function __construct(Container $container, callable|Transformer|string $fallback)
    {
        $this->container = $container;
        $this->fallback = $fallback;
    }

    /**
     * Register a transformable to transformer binding.
     *
     * @param array|string $transformable
     * @param callback|string $transformer
     * @return void
     */
    public function bind(array|string $transformable, callable|string $transformer): void
    {
        $this->bindings = array_merge($this->bindings, is_array($transformable) ? $transformable : [
            $transformable => $transformer,
        ]);
    }

    /**
     * Resolve a transformer.
     *
     * @param callable|Transformer|string $transformer
     * @return Transformer|callable
     * @throws InvalidTransformerException
     * @throws BindingResolutionException
     */
    public function resolve(callable|Transformer|string $transformer): callable|Transformer
    {
        if (is_string($transformer)) {
            return $this->container->make($transformer);
        }

        if (! is_callable($transformer) && ! $transformer instanceof Transformer) {
            throw new InvalidTransformerException();
        }

        return $transformer;
    }

    /**
     * Resolve a transformer from the given data.
     *
     * @param mixed $data
     * @return Transformer|callable
     */
    public function resolveFromData(mixed $data): callable|Transformer
    {
        $transformer = $this->resolveTransformer($this->resolveTransformableItem($data));

        return $this->resolve($transformer);
    }

    /**
     * Resolve a transformer from the transformable element.
     *
     * @param  mixed $transformable
     * @return Transformable|callable
     */
    protected function resolveTransformer(mixed $transformable): callable|Transformer|string|Transformable
    {
        if (is_object($transformable) && key_exists(get_class($transformable), $this->bindings)) {
            return $this->bindings[get_class($transformable)];
        }

        if ($transformable instanceof Transformable) {
            return $transformable->transformer();
        }

        return $this->resolve($this->fallback);
    }

    /**
     * Resolve a transformable item from the given data.
     *
     * @param  mixed $data
     * @return mixed
     */
    protected function resolveTransformableItem(mixed $data): mixed
    {
        if (is_array($data) || $data instanceof Traversable) {
            foreach ($data as $item) {
                return $item;
            }
        }

        return $data;
    }
}
