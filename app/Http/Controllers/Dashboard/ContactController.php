<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('user')->latest()->paginate(10);
        return view('dashboard.contacts.index', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                Rule::requiredIf(!auth()->check()),
                'string',
                'max:255'
            ],
            'email' => auth()->check() ?  'nullable' : 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'user_id' => auth()->id() ?? null,
            'name' => auth()->check() ? null : $request->name,
            'email' => auth()->check() ? null : $request->email,
            'message' => $request->message,
        ]);
        flash()->success('Your message has been sent successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('dashboard.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        flash()->success('Contact deleted successfully.');
        return redirect()->route('admin.contacts.index');
    }

    public function trash()
    {
        $contacts = Contact::onlyTrashed()->with('user')->latest()->paginate(10);
        return view('dashboard.contacts.trash', compact('contacts'));
    }

    public function restore(Contact $contact)
    {
        $contact->restore();
        flash()->success('Contact restored successfully.');
        return redirect()->route('admin.contacts.trash');
    }

    public function forceDelete(Contact $contact)
    {
        $contact->forceDelete();
        flash()->success('Contact permanently deleted successfully.');
        return redirect()->route('admin.contacts.trash');
    }
}
