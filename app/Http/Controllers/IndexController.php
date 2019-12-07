<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slide;
use App\Models\Article;
use App\Models\Language;

class IndexController extends Controller
{
    public function index()
    {
        $response['slides'] = Slide::all();
        $response['categories'] = Category::main()->get();
        $response['articles'] = Article::anchored()->get();
        return view('main_page.index', $response);
    }

    public function changeLanguage($locale) {
        $app_locales = Language::getLocales();
        if (in_array($locale, $app_locales)) {
            \App::setLocale($locale);
            session()->put('override_locale', $locale);
        }else{
            session()->put('override_locale', $locale);
            \App::setLocale(Language::getDefault());
        }

        return redirect()->back();
    }
}
