<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;
use App\PhotoProcessTrait;

class Slide extends Model
{
    use CrudTrait;
    use HasTranslations;
    use PhotoProcessTrait;

    protected $table = 'slides';
    protected $primaryKey = 'id';
    protected $fillable = ['label', 'title', 'description', 'image', 'show'];

    protected $translatable = ['label', 'title', 'description'];

    protected $image_properties = [
        'image' => [
            'sizes' => [
                'min' => ['width' => 120],
                'big' => ['width' => 1440],
            ],
            'disk' => 'uploads',
            'destination_path' => 'slides',
            'quality' => 85
        ]
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('show', function ($builder) {
            $builder->where('show', 1);
        });
    }

    public function setImageAttribute($value)
    {
        $this->uploadPhotoToDisk($value, 'image');
    }
}
