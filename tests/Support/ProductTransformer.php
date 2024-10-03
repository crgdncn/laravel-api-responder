<?php

namespace Flugg\Responder\Tests\Support;

use Flugg\Responder\Transformers\Transformer;

class ProductTransformer extends Transformer
{
    protected $relations = [
        'shipments' => ShipmentTransformer::class,
        'orders' => OrderTransformer::class,
    ];

    public function transform(Product $product)
    {
        return $product->fresh()->toArray();
    }
}
