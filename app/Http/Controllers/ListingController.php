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
        //dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2));
        return view('listings.index', [
            //'listings' => Listing::all()
            //'listings' => Listing::latest()->get()
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
            //'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(2)
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


        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing creted succefully!');
    }


    //Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }


    //Update listing data
    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);


        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated succefully!');
    }
}
