<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transport';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function setCapacityAttribute($value)
    {
        $this->attributes['capacity'] = ($value == 0 or empty($value)) ? null : $value;
    }

    public function setBagsAttribute($value)
    {
        $this->attributes['bags'] = ($value == 0 or empty($value)) ? null : $value;
    }
}
