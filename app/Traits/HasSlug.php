<?php

namespace App\Traits;

use App\Models\Slug;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->getSlugSource());
            }
        });

        static::updating(function ($model) {

            if ($model->isDirty($model->getSlugSourceColumn())) {
                $model->slugHistory()->create([
                    'slug' => $model->getOriginal('slug'),
                ]);
                
                $model->slug = static::generateUniqueSlug($model->getSlugSource());
                }
        });
    }

    public function getSlugSource()
    {
        return $this->{$this->getSlugSourceColumn()};
    }

    public function getSlugSourceColumn()
    {
        return 'title'; //  هاي بقدر اغيرها من الموديل اللي بيستخدم التريت لو حبيت 
    }

    public static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function slugHistory()
    {
        return $this->morphMany(Slug::class, 'sluggable');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
