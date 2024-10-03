<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */

/** @noinspection ALL */

namespace Flugg\Responder\Http\Responses;

use BadMethodCallException;
use Flugg\Responder\Contracts\ResponseFactory;
use Flugg\Responder\TransformBuilder;
use InvalidArgumentException;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\SerializerAbstract;

/**
 * A builder class for building success responses.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 *
 * @method $this meta(array $meta)
 * @method $this with(array | string $relations)
 * @method $this without(array | string $relations)
 * @method $this serializer(SerializerAbstract | string $serializer)
 * @method $this paginator(IlluminatePaginatorAdapter $paginator)
 * @method $this cursor(Cursor $cursor)
 */
class SuccessResponseBuilder extends ResponseBuilder
{
    /**
     * A builder for building transformed arrays.
     *
     * @var \Flugg\Responder\TransformBuilder
     */
    protected $transformBuilder;

    /**
     * An HTTP status code for the response.
     *
     * @var int
     */
    protected $status = 200;

    /**
     * Construct the builder class.
     *
     * @param \Flugg\Responder\Contracts\ResponseFactory $responseFactory
     * @param \Flugg\Responder\TransformBuilder          $transformBuilder
     */
    public function __construct(ResponseFactory $responseFactory, TransformBuilder $transformBuilder)
    {
        $this->transformBuilder = $transformBuilder;

        parent::__construct($responseFactory);
    }

    /**
     * Set resource data for the transformation.
     *
     * @param mixed|null $data
     * @param callable|\Flugg\Responder\Transformers\Transformer|string|null $transformer
     * @param  string|null                                                    $resourceKey
     * @return self
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function transform(mixed $data = null, callable|\Flugg\Responder\Transformers\Transformer|string $transformer = null, string $resourceKey = null): SuccessResponseBuilder
    {
        $this->transformBuilder->resource($data, $transformer, $resourceKey);

        return $this;
    }

    /**
     * Dynamically send calls to the transform builder.
     *
     * @param string $name
     * @param array $arguments
     * @return self|void
     */
    public function __call(string $name, array $arguments)
    {
        if (in_array($name, ['cursor', 'paginator', 'meta', 'with', 'without', 'only', 'serializer'])) {
            $this->transformBuilder->$name(...$arguments);

            return $this;
        }

        throw new BadMethodCallException();
    }

    /**
     * Get the serialized response output.
     *
     * @return mixed
     */
    protected function getOutput(): array
    {
        return $this->transformBuilder->transform();
    }

    /**
     * Validate the HTTP status code for the response.
     *
     * @param  int $status
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validateStatusCode(int $status): void
    {
        if ($status < 100 || $status >= 400) {
            throw new InvalidArgumentException("{$status} is not a valid success HTTP status code.");
        }
    }
}
