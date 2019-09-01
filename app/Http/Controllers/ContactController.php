<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Subscriber;
use App\Models\ContactResponse;
use Illuminate\Support\Facades\Lang;
use App\Mail\ContactResponse as MailContactResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\Subscriber as MailSubscriber;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $address_contacts = $contacts->where('no_address', 0);
        $no_address_contacts = $contacts->where('no_address', 1);
        return view('contacts', compact('address_contacts', 'no_address_contacts'));
    }

    public function subscribe(Request $request)
    {
        $message = $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'company' => 'required|max:191',
        ]);
        $subscriber = Subscriber::create($message);

        $email = filter_var(Lang::get('emails.subscriber.email'), FILTER_VALIDATE_EMAIL) ? Lang::get('emails.subscriber.email') : env('FALLBACK_EMAIL');
        Mail::to($email)->send(new MailSubscriber($subscriber));
        return ['status' => 'success', 'message' => Lang::get('messages.subscribe')];
    }

    public function store(Request $request)
    {
        $message = $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'message' => 'required',
            'subject' => 'string|max:191',
            'phone' => 'string|max:191',
        ]);
        $contact = ContactResponse::create($message);
        $email = filter_var(Lang::get('emails.contact_response.email'), FILTER_VALIDATE_EMAIL) ? Lang::get('emails.contact_response.email') : env('FALLBACK_EMAIL');
        Mail::to($email)->send(new MailContactResponse($contact));
        return ['status' => 'success', 'message' => Lang::get('messages.contact_response')];
    }
}
