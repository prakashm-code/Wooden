<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function storeEnquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $enquiry = new Enquiry();
        $enquiry->name = $validated['name'];
        $enquiry->email = $validated['email'];
        $enquiry->phone = $validated['phone'];
        $enquiry->message = $validated['message'];
        $enquiry->state = $request->state;
        $enquiry->city = $request->city;
        $enquiry->product = $request->product;
        $enquiry->save();

        return Redirect::route('home')->with('msg_success', 'Enquiry added successfully!');
    }
}
