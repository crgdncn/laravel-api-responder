<?php

namespace Flugg\Responder\Tests\Support;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $table = 'orders';
    protected $casts = [
        'product_id' => 'int',
        'customer_id' => 'int',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
