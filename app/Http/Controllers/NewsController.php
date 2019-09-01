<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response['articles'] = Article::published()->paginate(15);
        if (request()->expectsJson()) {
            return $response['articles'];
        }
        $response['page'] = Page::where('slug', 'news')->first();

        return view('news.index', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $last_articles = Article::published()->where('id', '!=', $article->id)->limit(3)->get();
        $breadcrumbs[] = ['title' => 'Новости', 'path' => route('news')];
        return view('news.show', compact('article', 'last_articles', 'breadcrumbs'));
    }
}
