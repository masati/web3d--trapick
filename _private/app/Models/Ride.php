<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belong(Order::class, 'order_id', 'id');
    }
}
