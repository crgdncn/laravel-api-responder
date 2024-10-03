<?php

namespace Flugg\Responder\Tests\Support;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $table = 'products';

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
