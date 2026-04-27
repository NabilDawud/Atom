<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes, HasSlug;
    protected $guarded = [];

    protected $casts = ['published_at' => 'datetime'];


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function post_contents()
    {
        return $this->hasMany(PostContent::class)->orderBy('order');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
