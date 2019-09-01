<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use App\PhotoProcessTrait;

class Contact extends Model
{
    use CrudTrait;
    use HasTranslations;
    use PhotoProcessTrait;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'address', 'email', 'phones', 'place_id', 'no_address', 'text', 'image', 'parent_id', 'lft', 'rgt', 'depth'];

    protected $translatable = ['title', 'address', 'email', 'phones', 'text'];

    protected $casts = ['no_address' => 'boolean', 'phones' => 'object', 'address' => 'object'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 75],
                'min' => ['width' => 275],
            ],
            'disk' => 'uploads',
            'destination_path' => 'contacts',
            'quality' => 80
        ]
    ];

    public function scopeWithAddress($query)
    {
        return $query->where('no_addres', 0);
    }

    public function scopeWithoutAddress($query)
    {
        return $query->where('no_addres', 1);
    }

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }
}
