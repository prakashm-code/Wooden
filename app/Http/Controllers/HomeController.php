<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request){
         $title = 'Home';
        $page = 'index';
        $js = ['validate'];

return view('index', compact(
    'title',
    'js'
));
    }
    public function listing(Request $request){
         $title = 'Listing';
        $page = 'index';
        $js = ['validate'];

return view('listing', compact(
    'title',
    'js'
));
    }
}
