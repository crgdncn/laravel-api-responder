<?php

namespace Flugg\Responder\Tests\Support;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];
    protected $table = 'shipments';
    protected $casts = [
        'product_id' => 'int',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
