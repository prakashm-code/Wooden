<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController
{

    /*
    |--------------------------------------------------------------------------
    | Show Settings Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $title = 'Setting';
        $page = 'admin.setting.addUpdate';
        $js = ['setting'];
        $outlet_id = 11;

        $settings = Setting::first();
        if (!$settings) {
            $settings = Setting::create([
                'gst_percentage' => 5,
                'parcel_charge_per_item' => 0,
                'total_tables' => 10,
                'address' => '',
                'phone' => '',
                'email' => '',
                'outlet_id' => $outlet_id
            ]);
        }

        return view("layouts.layout", compact(
            'title',
            'page',
            'settings'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Update Settings
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        // dd($request);
        $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            // 'gst_percentage' => 'required|numeric|min:0',
            'parcel_charge_per_item' => 'required|numeric|min:0',
            // 'total_tables' => 'required|integer|min:1',
        ]);

        $outlet_id = auth()->user()->outlet_id;

        $setting = Setting::where('outlet_id', $outlet_id)->first();

        // $setting = new Setting();
        $setting->restaurant_name = $request->restaurant_name;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->gst_number = $request->gst_number;
        // $setting->gst_percentage = $request->gst_percentage;
        $setting->parcel_charge_per_item = $request->parcel_charge_per_item;
        // $setting->total_tables = $request->total_tables;
        $setting->save();

        return back()->with('msg_success', 'Settings Updated Successfully');
    }


    public function userProfile()
    {
        $title = 'My Profile';
        $page  = 'admin.setting.profile';
        $js = ['login'];
        $user  = auth()->user();

        return view('layouts.layout', compact('title', 'page', 'user', 'js'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'         => ['nullable', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'name.required'         => 'Please enter your name.',
            'email.required'        => 'Please enter your email.',
            'email.email'           => 'Please enter a valid email address.',
            'email.unique'          => 'This email is already taken.',
            'profile_photo.image'   => 'File must be an image.',
            'profile_photo.mimes'   => 'Only JPG, PNG, WEBP allowed.',
            'profile_photo.max'     => 'Photo must be under 2MB.',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // ✅ Handle photo upload only if a new file was selected
        if ($request->hasFile('profile_photo')) {

            // Delete old photo if exists
            if (
                $user->profile_photo &&
                file_exists(public_path('uploads/profiles/' . $user->profile_photo))
            ) {
                unlink(public_path('uploads/profiles/' . $user->profile_photo));
            }

            $file     = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profiles'), $filename);

            $data['profile_photo'] = $filename;
        }

        User::where('id', $user->id)->update($data);

        return back()->with('msg_success', 'Profile updated successfully.');
    }
}
