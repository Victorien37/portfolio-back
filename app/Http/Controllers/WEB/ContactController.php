<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function index() : View
    {
        $contacts = Contact::all();
        return view('contact.index', compact('contacts'));
    }

    public function delete(Contact $contact) : JsonResponse
    {
        $contact->delete();

        return response()->json("Contact deleted successfully.");
    }
}
