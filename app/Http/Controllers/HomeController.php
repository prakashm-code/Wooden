<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\BlockBoard;
use App\Models\Door;
use App\Models\Enquiry;
use App\Models\Plywood;
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
        $plywoods = Plywood::orderBy('id', 'desc')->take(4)->get();
        $doors = Door::orderBy('id', 'desc')->take(4)->get();
        $blockboards = BlockBoard::orderBy('id', 'desc')->take(4)->get();

        $settings = StoreSetting::first();

        return view('index', compact(
            'title',
            'js',
            'settings',
            'plywoods',
            'doors',
            'blockboards'
        ));
    }
    public function listing(Request $request)
    {
        $title = 'Listing';
        $page = 'index';
        $js = ['validate'];
        $category = $request->cat;
        // dd($category);
        if ($category == 'plywoods') {
            $plywoods = Plywood::all();
            return view('listing', compact(
                'title',
                'js',
                'category',
                'plywoods'
            ));
        }
        if ($category == 'doors') {
            $doors = Door::all();
            return view('listing', compact(
                'title',
                'js',
                'category',
                'doors'
            ));
        }
        if ($category == 'blockboards') {
            $blockboards = BlockBoard::all();
            return view('listing', compact(
                'title',
                'js',
                'category',
                'blockboards'
            ));
        }
    }
}
