<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];    

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function post_contents()
    {
        return $this->hasMany(PostContent::class)->orderBy('order');
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
