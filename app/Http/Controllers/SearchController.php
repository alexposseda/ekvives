<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $products = $request->has('s') ? Product::searchAll($request->s) : collect([]);
        if($request->expectsJson())
        {
            return $products;
        }
        $categories = Category::getAll();
        return view('search', compact('products', 'categories'));
    }
}
