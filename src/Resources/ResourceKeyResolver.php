<?php /** @noinspection ALL */

namespace Flugg\Responder\Resources;

use Flugg\Responder\Contracts\Resources\ResourceKeyResolver as ResourceKeyResolverContract;
use Illuminate\Database\Eloquent\Model;
use Traversable;

/**
 * This class is responsible for resolving resource keys.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class ResourceKeyResolver implements ResourceKeyResolverContract
{
    /**
     * Transformable to resource key mappings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * Register a transformable to resource key binding.
     *
     * @param array|string $transformable
     * @param  string       $resourceKey
     * @return void
     */
    public function bind(array|string $transformable, string $resourceKey): void
    {
        $this->bindings = array_merge($this->bindings, is_array($transformable) ? $transformable : [
            $transformable => $resourceKey,
        ]);
    }

    /**
     * Resolve a resource key from the given data.
     *
     * @param mixed $data
     * @return string
     */
    public function resolve(mixed $data): string
    {
        $transformable = $this->resolveTransformableItem($data);

        if (is_object($transformable) && key_exists(get_class($transformable), $this->bindings)) {
            return $this->bindings[get_class($transformable)];
        }

        if ($transformable instanceof Model) {
            return $this->resolveFromModel($transformable);
        }

        return 'data';
    }

    /**
     * Resolve a resource key from the given model.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return string
     */
    public function resolveFromModel(Model $model): string
    {
        if (method_exists($model, 'getResourceKey')) {
            return $model->getResourceKey();
        }

        return $model->getTable();
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
