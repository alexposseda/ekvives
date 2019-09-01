<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\ModelTraits\SpatieTranslatable\HasTranslations;

class MenuItem extends Model
{
    use CrudTrait;
    use HasTranslations;

    protected $table = 'menu_items';
    protected $fillable = ['name', 'type', 'link', 'page_id', 'parent_id'];
    protected $translatable = ['name'];

    public static function boot()
    {
        parent::boot();
        static::creating(function () {
            \Cache::forget('menu_items');
        });

        static::updating(function () {
            \Cache::forget('menu_items');
        });

        static::deleting(function () {
            \Cache::forget('menu_items');
        });
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuItem', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\MenuItem', 'parent_id')->with('children', 'page');
    }

    public function page()
    {
        return $this->belongsTo('Backpack\PageManager\app\Models\Page', 'page_id');
    }

    public static function getAll()
    {
        return \Cache::rememberForever('menu_items', function () {
            return MenuItem::with('children', 'page')->get();
        });
    }

    /**
     * Get all menu items, in a hierarchical collection.
     * Only supports 2 levels of indentation.
     */
    public static function getTree($name = 'Header')
    {
        return self::getAll()->where('name', $name)->first()->children->sortBy('lft');
    }

    public function url()
    {
        switch ($this->type) {
            case 'external_link':
                return $this->link;
                break;

            case 'internal_link':
                return is_null($this->link) ? '#' : url($this->link);
                break;

            case 'categories_link':
                return '#';
                break;

            default: //page_link
                if ($this->page) {
                    return url($this->page->slug);
                }
                break;
        }
    }
}
