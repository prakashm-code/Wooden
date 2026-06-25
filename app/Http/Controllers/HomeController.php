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

        return view('layouts.front_layout', compact(
            'title',
            'js',
            'page',
            'settings',
            'plywoods',
            'doors',
            'blockboards'
        ));
    }
    public function listing(Request $request)
    {
        $title = 'Listing';
        $page = 'listing';
        $js = ['validate'];
        $category = $request->cat;
        $settings = StoreSetting::first();

        // dd($category);
        if ($category == 'plywoods') {
            $plywoods = Plywood::all();
            return view('layouts.front_layout', compact(
                'title',
                'js',
                'page',
                'category',
                'plywoods',
                'settings'
            ));
        }
        if ($category == 'doors') {
            $doors = Door::all();
            return view('layouts.front_layout', compact(
                'title',
                'js',
                'page',
                'category',
                'settings',
                'doors'
            ));
        }
        if ($category == 'blockboards') {
            $blockboards = BlockBoard::all();
            return view('layouts.front_layout', compact(
                'title',
                'js',
                'page',
                'category',
                'blockboards',
                'settings'
            ));
        }
    }
}
