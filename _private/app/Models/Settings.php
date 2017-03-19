<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $timestamps = false;

    const NAV_STEPS = [
        1 => "glyphicon glyphicon-pushpin",
        2 => "glyphicon glyphicon-tag",
        3 => "glyphicon glyphicon-user",
        4 => "glyphicon glyphicon-credit-card",
        5 => "glyphicon glyphicon-ok"
    ];
}
