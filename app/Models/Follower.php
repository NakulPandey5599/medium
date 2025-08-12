<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model

{
    protected const CREATED_AT = null;


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
