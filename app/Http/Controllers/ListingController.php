<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Get all listings
    public function index()
    {
        return view('listings', [
            'listings' => Listing::all()
        ]);
    }

    // Get single listing
    public function show(Listing $listing)
    {
        // $exist = Listing::find($listing);

        // if ($exist) {
        return view('listing', [
            'listing' => $listing
        ]);
        // } else {
        //     abort('404');
        //}
    }
}
