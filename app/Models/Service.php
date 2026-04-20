<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
      protected $guarded = [];    

      public function image()
      {
          return $this->morphOne(Image::class, 'imageable');
      }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
