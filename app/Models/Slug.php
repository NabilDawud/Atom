<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $guarded = [];

    public function sluggable()
    {
        return $this->morphTo();
    }
}
