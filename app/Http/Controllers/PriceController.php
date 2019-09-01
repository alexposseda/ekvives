<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\PriceClarify;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\PriceClarify as MailPriceClarify;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response['prices'] = Price::orderBy('lft')->paginate(9);
        return view('prices', $response);
    }

    public function store(Request $request)
    {
        $message = $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'string|max:191',
        ]);
        $price_clarify = PriceClarify::create($message);

        $email = filter_var(Lang::get('emails.price_clarify.email'), FILTER_VALIDATE_EMAIL) ? Lang::get('emails.price_clarify.email') : env('FALLBACK_EMAIL');
        Mail::to($email)->send(new MailPriceClarify($price_clarify));
        return ['status' => 'success', 'message' => Lang::get('messages.price_clarify')];
    }
}
