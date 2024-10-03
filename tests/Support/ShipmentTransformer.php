<?php

namespace Flugg\Responder\Tests\Support;

use Flugg\Responder\Transformers\Transformer;

class ShipmentTransformer extends Transformer
{
    public function transform(Shipment $shipment)
    {
        return $shipment->fresh()->toArray();
    }
}
