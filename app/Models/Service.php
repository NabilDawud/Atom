<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
  protected $guarded = [];

  protected $with = ['images'];

  public function images()
      {
    return $this->morphMany(Image::class, 'imageable');
      }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

  public function  getWhiteImageAttribute()
  {
    return $this->images->where('type', 'white')->first();
  }


  public function  getBlackImageAttribute()
  {
    return $this->images->where('type', 'black')->first();
  }
}
