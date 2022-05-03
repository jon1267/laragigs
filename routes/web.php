<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

// All listings
Route::get('/', function () {
    //return view('welcome');
    return view('listings', [
        'listings' => Listing::all()
    ]);
});

// Single listing
Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listing', [
        'listing' => $listing
    ]);
});

/*Route::get('hello', function () {
    return response('<h1>Hello World</h1>', 200)
        ->header('Content-Type', 'text/plain')
        ->header('foo', 'bar');
});*/

Route::get('/posts/{id}', function ($id) {
    return response('Post ' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    dd($request); // $request->query
});
