<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Traits\FileHaving;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use App\PhotoProcessTrait;

class Document extends Model
{
    use CrudTrait;
    use FileHaving;
    use HasTranslations;
    use PhotoProcessTrait;

    protected $table = 'documents';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'file', 'image', 'parent_id', 'lft', 'rgt', 'depth'];
    protected $translatable = ['title', 'description'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
               'min' => ['width' => 70],
                'mid' => ['width' => 360],
                'big' => ['width' => 746],
            ],
            'disk' => 'uploads',
            'destination_path' => 'documents',
            'quality' => 80
        ]
    ];

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }
}
