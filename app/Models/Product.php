<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\PhotoProcessTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use App\Traits\FileHaving;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Traits\SearchTrait;

class Product extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    use HasTranslations;
    use PhotoProcessTrait;
    use FileHaving;
    use SearchTrait;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'article', 'slug', 'content', 'image', 'images',
     'category_id', 'catalog', 'price', 'meta_title', 'meta_description', 'no_index', 'suggested_category_id', 'suggested_product_id', 'seo_text', 'banner'];
    protected $translatable = ['title', 'article', 'content', 'meta_title', 'meta_description', 'seo_text'];
    protected $search_fields = ['title', 'article'];

    protected $casts = ['images' => 'array'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 180],
                'big' => ['width' => 385],
            ],
            'disk' => 'uploads',
            'destination_path' => 'products',
            'quality' => 100
        ],
        'banner' => [
            'sizes' => [
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'product_banners',
            'quality' => 100
        ]
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function () {
            \Cache::flush();
        });

        static::updating(function () {
            \Cache::flush();
        });

        static::deleting(function ($obj) {
            \Cache::flush();
            if ($obj->price && $obj->price != '/uploads/') {
                unlink(public_path('/uploads/' . $obj->price));
            }
            if ($obj->catalog && $obj->catalog != '/uploads/') {
                unlink(public_path('/uploads/' . $obj->catalog));
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->with('children');
    }

    public function suggestedCategories()
    {
        return $this->belongsToMany(Category::class, 'suggested_categories', 'product_id', 'suggested_category_id');
    }

    public function suggestedProducts()
    {
        return $this->belongsToMany(Product::class, 'suggested_products', 'product_id', 'suggested_product_id');
    }

    public static function getAll()
    {
        return \Cache::rememberForever('products', function () {
            return Product::where('category_id', '!=', 0)->with('category')->get();
        });
    }

    public static function searchAll($words)
    {
        return self::filteredCollection(self::getAll(), $words);
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
        if (isset($this->category->path)) {
            return $this->category->path . '/' . $this->slug;
        }
        return false;
    }

    public function getBreadcrumbsAttribute()
    {
        return $this->category->getBreadcrumbs();
    }

    public function setPriceAttribute($value)
    {
        $attribute_name = 'price';
        $disk = 'uploads';
        $instance = self::latest()->first();
        $id = $this->id ?? ($instance->id ?? 1);
        $destination_path = "{$this->table}/{$id}";
        $this->uploadPdfToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function setCatalogAttribute($value)
    {
        $attribute_name = 'catalog';
        $disk = 'uploads';
        $instance = self::latest()->first();
        $id = $this->id ?? ($instance->id ?? 1);
        $destination_path = "{$this->table}/{$id}";
        $this->uploadPdfToDisk($value, $attribute_name, $disk, $destination_path);
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
