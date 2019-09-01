<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Carbon\Carbon;
use App\PhotoProcessTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;

class Article extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    use PhotoProcessTrait;
    use HasTranslations;

    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'published_at',
        'slug',
        'description',
        'anchored',
        'image',
        'video',
        'use_video',
        'meta_title',
        'meta_description',
        'no_index',
        'seo_text',
        'banner'
    ];
    protected $casts = ['published_at' => 'datetime'];
    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 275],
                'mid' => ['width' => 570],
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'articles',
            'quality' => 100
        ],
        'banner' => [
            'sizes' => [
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'article_banners',
            'quality' => 100
        ]
    ];

    protected $translatable = ['title', 'content', 'description', 'meta_title', 'meta_description', 'seo_text'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }
        return $this->title;
    }

    public function getPathAttribute()
    {
        return route('article', $this);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');
    }

    public function scopeAnchored($query)
    {
        return $query->where('anchored', 1);
    }

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = \Date::parse($value);
    }

    public function setBannerAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'banner');
    }
}
