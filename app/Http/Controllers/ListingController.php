<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

use function Ramsey\Uuid\v1;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index', [
            'listings' => Listing::latest()
            ->filter(request(['tag', 'search']))
            ->paginate(4)
        ]);
    }

    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required', 'email', Rule::unique('listings', 'email')],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        $formFields['user_id'] = auth()->id();
 
        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully.');
    }

    public function edit(Listing $listing){
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing){

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing){

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully.');
    }

    public function manage(){
        $listings = auth()->user()->listings;
        return view('listings.manage', ['listings' => $listings]);
    }
}
