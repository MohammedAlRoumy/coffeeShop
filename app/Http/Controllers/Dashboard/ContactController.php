<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        //
        $contacts = ContactUs::whenSearch(request()->search)->orderBy('id','desc')->paginate();
        return view('dashboard.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = ContactUs::findOrFail($id);

        return view('dashboard.contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        //

        $contact = ContactUs::findOrFail($id);


        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'تمت عملية الحذف بنجاح');
    }
}
