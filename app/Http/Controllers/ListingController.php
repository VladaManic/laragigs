<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

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

    // Get create listings form page
    public function create()
    {
        return view('listings.create');
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
}
