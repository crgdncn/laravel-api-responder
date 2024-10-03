<?php

namespace Flugg\Responder\Tests\Support;

use Flugg\Responder\Transformers\Transformer;

class CustomerTransformer extends Transformer
{
    public function transform(Customer $customer)
    {
        return $customer->fresh()->toArray();
    }
}
