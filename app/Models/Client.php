<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $guarded = [];    

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
