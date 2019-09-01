<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Testimonial;
use App\Models\Language;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('layouts.footer', function ($view) {
            $response['last_testimonials'] = \Cache::rememberForever('last_testimonials', function () {
                return Testimonial::orderBy('rgt')->limit(3)->get();
            });            
            $response['footer_menu_items'] = MenuItem::getTree('Footer');

            $view->with($response);
        });

        \View::composer(['layouts.head', 'layouts.footer'], function ($view) {
            $page = Page::whereSlug(request()->path())->first();
            $view->with('page', $page);
        });

        \View::composer('layouts.header', function ($view) {
            $response['locales'] = Language::getLocales();
            $response['menu_items'] = MenuItem::getTree();
            $response['categories'] = Category::getAll()->filter(function ($category) { return $category->depth == 1; });
            $view->with($response);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
