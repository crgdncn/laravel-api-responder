<?php /** @noinspection ALL */
/** @noinspection ALL */

/** @noinspection ALL */

namespace Flugg\Responder;

use Flugg\Responder\Serializers\NoopSerializer;

/**
 * A class responsible for obtaining a transformation to transform data without serializing.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class Transformation
{
    /**
     * A builder used to build transformed arrays.
     *
     * @var \Flugg\Responder\TransformBuilder
     */
    protected $transformBuilder;

    /**
     * Construct the service class.
     *
     * @param \Flugg\Responder\TransformBuilder $transformBuilder
     */
    public function __construct(TransformBuilder $transformBuilder)
    {
        $this->transformBuilder = $transformBuilder;
    }

    /**
     * Make a new transformation to transform data without serializing.
     *
     * @param mixed|null $data
     * @param callable|\Flugg\Responder\Transformers\Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return \Flugg\Responder\TransformBuilder
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function make(mixed $data = null, callable|Transformers\Transformer|string $transformer = null, string $resourceKey = null): TransformBuilder
    {
        return $this->transformBuilder->resource($data, $transformer, $resourceKey)->serializer(new NoopSerializer());
    }
}
