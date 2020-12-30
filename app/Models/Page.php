<?php

namespace App\Models;

use Backpack\PageManager\app\Models\Page as PrevPage;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use App\PhotoProcessTrait;

class Page extends PrevPage
{
    use HasTranslations;
    use PhotoProcessTrait;
    protected $fillable = ['template', 'name', 'title', 'slug', 'content', 'meta_title', 'meta_description', 'no_index', 'seo_text', 'banner'];
    protected $translatable = ['title', 'content', 'meta_title', 'meta_description', 'seo_text'];
    protected $image_properties = [
        'banner' => [
            'sizes' => [
                'min' => ['width' => 144],
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'page_banners',
            'quality' => 100
        ]
    ];

    public function setBannerAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'banner');
    }
}
