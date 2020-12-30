<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function aboutUs()
    {
        $page = Page::where('name', 'about-us')->first();
        return view('pages.about-us', compact('page'));
    }
}
