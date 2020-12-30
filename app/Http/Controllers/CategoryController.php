<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Mail\Order as MailOrder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    public function show()
    {
        $categories = Category::getAll();

        $category = $categories->filter(function ($item) {
            if(\App::getLocale() == Language::getDefault()){
                return '/' . request()->path() == $item->path;
            }else{
                return '/' . request()->path() == '/' .$item->path;
            }
        })->first();

        if (!$category) {
            $product = Product::where('slug', collect(request()->segments())->last())->first();
            if ($product) {
                $breadcrumbs = array_reverse($product->breadcrumbs);


                return view('product', compact('product', 'breadcrumbs', 'categories'));
            }
        }

        if (!$category) {
            abort(404);
        }

//        if ($category->products->count() == 1) {
//            return redirect($category->products->first()->path);
//        }
        $breadcrumbs = $category->breadcrumbs;
//        var_dump($breadcrumbs); die();
        return view('category', compact('category', 'breadcrumbs', 'categories'));
    }

    public function store(Request $request)
    {
        $message = $request->validate([
            'title' => 'required|max:191',
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'message' => 'required',
            'company' => 'string|max:191',
            'phone' => 'string|max:191',
        ]);
        $order = Order::create($message);
        $email = filter_var(Lang::get('emails.order.email'), FILTER_VALIDATE_EMAIL) ? Lang::get('emails.order.email') : env('FALLBACK_EMAIL');
        Mail::to($email)->send(new MailOrder($order));
        return ['status' => 'success', 'message' => Lang::get('messages.order')];
    }
}
