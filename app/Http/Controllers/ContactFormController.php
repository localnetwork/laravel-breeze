<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactFormEntry;
use ProtoneMedia\Splade\Facades\Toast; 
use Illuminate\Support\Facades\Redirect; 

class ContactFormController extends Controller
{
    public function index()
    {
        // Fetch all contact form entries
        $entries = ContactFormEntry::all();
        return view('admin.contact.index', ['entries' => $entries]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        ContactFormEntry::create($request->all());
        
        Toast::title('Success')->message("Your submission has been received. We will get back to you shortly.")->success()->rightTop()->autoDismiss(5); 
        return Redirect::back();
        // return Redirect::route('pages.contact');
    }
}