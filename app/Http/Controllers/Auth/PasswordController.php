<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function index()
    {
        $title = 'Update Password';
        $page = 'auth.change-password';
        $js =['login'];

        return view("layouts.layout", compact(
            'title',
            'page',
            'js'
        ));
    }
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
    public function ChangeAdminStore(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'password'          => 'required',
            ]);
            $updatepwd = User::where(['id'=>$request->id,'email'=>$request->email])->first();
            $updatepwd->password = Hash::make($validated['password']);;
            $updatepwd->save();

            DB::commit();
            return redirect()->route('dashboard')->with('msg_success', 'Password updated successfully !');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('msg_error', 'Password not updated successfully !' . $e->getMessage());
        }
    }
}
