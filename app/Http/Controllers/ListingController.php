<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Get all listings
    public function index()
    {
        //dd(request());
        return view('listings.index', [
            //'listings' => Listing::all()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    // Get single listing
    public function show(Listing $listing)
    {
        // $exist = Listing::find($listing);

        // if ($exist) {
        return view('listings.show', [
            'listing' => $listing
        ]);
        // } else {
        //     abort('404');
        //}
    }

    // Get create listings form page
    public function create()
    {
        return view('listings.create');
    }

    //Store listing data
    public function store(Request $request)
    {
        //dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/');
    }
}
