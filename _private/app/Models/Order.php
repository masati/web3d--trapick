<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function routeFrom()
    {
        return $this->hasOne(Route::class, 'id', 'route_from');
    }

    public function routeTo()
    {
        return $this->hasOne(Route::class, 'id', 'route_to');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class, 'order_id', 'id');
    }
}
