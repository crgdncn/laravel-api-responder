<?php

namespace Flugg\Responder\Tests\Support;

use Flugg\Responder\Transformers\Transformer;

class OrderTransformer extends Transformer
{
    protected $relations = [
        'customer' => CustomerTransformer::class,
    ];

    public function transform(Order $order)
    {
        return $order->fresh()->toArray();
    }
}
