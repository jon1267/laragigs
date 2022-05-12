<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        //dd(request()->tag);dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show one listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show create form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listings Data
    public function store(Request $request)
    {
        //dd($request->file('logo')->store());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            // in storage/app/public crate dir logos && file store with average name
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')
            ->with('message', 'Listing created successfully!');
    }
}
