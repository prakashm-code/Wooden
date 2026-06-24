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
        $enquiry->phone_number = $validated['phone'];
        $enquiry->message = $validated['message'];
        $enquiry->state = '';
        $enquiry->city = $request->city ?? "";
        $enquiry->product = $request->product ?? "";
        $enquiry->save();

        return response()->json([
            'success' => true,
            'message' => 'Enquiry submitted successfully'
        ]);
    }
}
