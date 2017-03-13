<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['title', 'content'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
