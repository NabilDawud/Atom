<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statistic extends Model
{
    use SoftDeletes;
        protected $guarded = [];

    protected $with = ['image'];
        public function image()
        {
            return $this->morphOne(Image::class, 'imageable');
        }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
