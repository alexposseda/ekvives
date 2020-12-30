<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use Backpack\LangFileManager\app\Models\Language as Lang;


class Language extends Lang
{
    public static function boot()
    {
        parent::boot();
        static::creating(function () {
            \Cache::forget('app_locales');
            \Cache::forget('default');            
        });

        static::updating(function () {
            \Cache::forget('app_locales');
            \Cache::forget('default');            
        });

        static::deleting(function () {
            \Cache::forget('app_locales');
            \Cache::forget('default');            
        });
    }

    public static function getLocales()
    {
        return \Cache::rememberForever('app_locales', function () {
            return Language::where('active', 1)->get()->pluck('abbr')->toArray();
        });
    }

    public static function getDefault()
    {
        return \Cache::rememberForever('default', function () {
            return Language::where('default', 1)->first()->abbr;
        });
    }
}
