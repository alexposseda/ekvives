<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $response['testimonials'] = Testimonial::all();
        return view('testimonials', $response);
    }
}
