<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostContent extends Model
{
    protected $guarded = [];    

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
