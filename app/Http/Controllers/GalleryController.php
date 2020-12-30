<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response['galleries'] = Gallery::published()->paginate(16);
        if (request()->expectsJson()) {
            return $response['galleries'];
        }
        return view('galleries.index', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $breadcrumbs[] = ['title' => 'Галерея', 'path' => route('galleries')];        
        return view('galleries.show', compact('gallery', 'breadcrumbs'));
    }
}
