<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Traits\FileHaving;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use App\PhotoProcessTrait;

class Testimonial extends Model
{
    use CrudTrait;
    use FileHaving;
    use HasTranslations;
    use PhotoProcessTrait;

    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'file', 'image', 'gallery_id', 'parent_id', 'lft', 'rgt', 'depth'];
    protected $translatable = ['title', 'description'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 70],
                'mid' => ['width' => 350],
                'big' => ['width' => 746],
            ],
            'disk' => 'uploads',
            'destination_path' => 'testimonials',
            'quality' => 90
        ]
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function () {
            \Cache::forget('last_testimonials');
        });

        static::updating(function () {
            \Cache::forget('last_testimonials');
        });

        static::deleting(function () {
            \Cache::forget('last_testimonials');
        });
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }
}
