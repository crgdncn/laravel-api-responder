<?php

namespace Flugg\Responder\Tests\Support;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    protected $table = 'customers';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
