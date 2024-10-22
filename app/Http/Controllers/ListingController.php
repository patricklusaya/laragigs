<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{



    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }


    public function create()
    {

        return view('listings.create');
    }

    public function edit(Listing $listing)
    {


        return view('listings.edit', ["listing" => $listing]);
    }

    public function show($id)
    {

        return view('listings.show', [

            "listing" => Listing::find($id)

        ]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([

            "name" => "required",
            "company" => "required",
            "tags" => "nullable",  // Allow it to be empty
            "location" => "nullable",
            "description" => "nullable",
            "email" => "nullable",

        ]);

        if ($request->hasFile('logo')) {

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = Auth::id();
        Listing::create($formFields);


        return redirect('/');
    }


    public function update(Request $request, Listing $listing)
    {

        // dd(Auth::id());


        $formFields = $request->validate([

            "name" => "required",
            "company" => "required",
            "tags" => "nullable",  // Allow it to be empty
            "location" => "nullable",
            "description" => "nullable",
            "email" => "nullable",



        ]);

        if ($request->hasFile('logo')) {

            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }


       



        $listing->update($formFields);


        return back();
    }

    
public function destroy(Listing $listing)
{
    $listing->delete();
   return back();
}


public function manage() {
    $user = Auth::user();
    
    // Retrieve the listings associated with the current user
    $listings = $user->listings;

    // Debugging: Check if listings are retrieved
    // dd($listings); // You should see the listings here
    return view('listings.manage', ['listings' => $listings]);

}

}

