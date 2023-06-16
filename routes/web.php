<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

//All listings
Route::get('/', [ListingController::class, 'index']);

//Create form page
Route::get('/listings/create', [ListingController::class, 'create']);

//Store listing data
Route::post('/listings', [ListingController::class, 'store']);

//Show edit form
Route::get('listings/{listing}/edit', [ListingController::class, 'edit']);

//Update Listing
Route::put('listings/{listing}', [ListingController::class, 'update']);

//Delete Listing
Route::delete('listings/{listing}', [ListingController::class, 'destroy']);

//Single listing (GOES LAST!)
Route::get('/listings/{listing}', [ListingController::class, 'show']);


//Show Register/Create form
Route::get('/register', [UserController::class, 'create']);

//Show Register/Create form
Route::post('/users', [UserController::class, 'store']);

//Logout user
Route::post('/logout', [UserController::class, 'logout']);

//Show login form
Route::get('/login', [UserController::class, 'login']);

//Login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
