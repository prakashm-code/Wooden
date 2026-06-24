<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Enquiry;
use App\Models\StoreSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Home';
        $page = 'index';
        $js = ['validate'];

        $settings = StoreSetting::first();

        return view('index', compact(
            'title',
            'js',
            'settings'

        ));
    }
    public function listing(Request $request)
    {
        $title = 'Listing';
        $page = 'index';
        $js = ['validate'];

        return view('listing', compact(
            'title',
            'js'
        ));
    }
}
