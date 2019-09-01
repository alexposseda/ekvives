<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Traits\FileHaving;
use App\PhotoProcessTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;

class Price extends Model
{
    use CrudTrait;
    use FileHaving;
    use HasTranslations;
    use PhotoProcessTrait;

    protected $table = 'prices';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'file', 'image', 'parent_id', 'lft', 'rgt', 'depth'];
    protected $translatable = ['title', 'description'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 70],
                'mid' => ['width' => 360],
                'big' => ['width' => 1920],
            ],
            'disk' => 'uploads',
            'destination_path' => 'prices',
            'quality' => 80
        ]
    ];

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }
}
