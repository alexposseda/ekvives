<?php

namespace App\Models;

use App\PhotoProcessTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;

class Category extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    use HasTranslations;
    use PhotoProcessTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'mini', 'description', 'image', 'anchored', 'slug', 'parent_id',
     'lft', 'rgt', 'depth', 'meta_title', 'meta_description', 'no_index', 'seo_text', 'banner'];
    protected $translatable = ['title', 'mini', 'description', 'meta_title', 'meta_description', 'seo_text'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 255],
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'categories',
            'quality' => 85
        ],
        'banner' => [
            'sizes' => [
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'category_banners',
            'quality' => 100
        ]
    ];

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

    public static function boot()
    {
        parent::boot();
        static::creating(function () {
            \Cache::forget('categories');
        });

        static::updating(function () {
            \Cache::forget('categories');
        });

        static::deleting(function () {
            \Cache::forget('categories');
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children', 'parent');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->with('category');
    }

    public static function getAll()
    {
        return \Cache::rememberForever('categories', function () {
            return Category::with('children', 'products', 'parent')->get();
        });
    }

    public function getPrePath()
    {
        if ($this->depth > 1) {
            return  $this->parent->getPrePath() . '/' . $this->parent->slug;
        }
        return '';
    }

    public function getBreadcrumbs($breadcrumbs = [])
    {
        $breadcrumbs[] = ['title' => $this->title, 'path' => $this->path];
        if ($this->depth > 1) {
            $breadcrumbs = $this->parent->getBreadcrumbs($breadcrumbs);
        }
        return $breadcrumbs;
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
        return $this->getPrePath() . '/' . $this->slug;
    }

    public function getBreadcrumbsAttribute()
    {
        return $this->parent ? $this->parent->getBreadcrumbs() : [];
    }

    public function scopeMain($query)
    {
        return $query->where('anchored', 1);
    }

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }

    public function setBannerAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'banner');
    }
}
