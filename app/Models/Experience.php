<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $with = ['image'];

    protected $casts = ['start_date' => 'datetime', 'end_date' => 'datetime'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
