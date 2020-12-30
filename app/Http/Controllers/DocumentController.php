<?php

namespace App\Http\Controllers;

use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $response['documents'] = Document::all();
        return view('documents', $response);
    }
}
