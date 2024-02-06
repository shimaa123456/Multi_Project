<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactForm = ContactForm::latest()->paginate(25);
        //
        return view("admin.contactForm.index", compact("contactForm"))->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contactForm = ContactForm::where("id", $id)->first();

        $contactForm->isRead = 1;

        $contactForm->save();

        return view("admin.contactForm.show", compact("contactForm"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
