<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
   public function list(Request $request)
    {
        // dd(1);
        try{

        $query = User::where('role','!=','super_admin');

        if($request->branch_id){
            $query->where('outlet_id',$request->branch_id);
        }

        if($request->search){
            $query->where('name','LIKE','%'.$request->search.'%');
        }

        $data = $query
            ->orderBy($request->sort ?? 'id',$request->order ?? 'desc')
            ->paginate($request->per_page ?? 10);

        return [
            'status'=>1,
            'message'=>'Staff list',
            'data'=>$data
        ];

        }catch(\Exception $e){

        return [
            'status'=>0,
            'message'=>$e->getMessage()
        ];

        }
    }



    public function store(Request $request)
    {
        try{

        $staff = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'outlet_id'=>$request->branch_id,
            'is_active'=>1
        ]);

        return [
            'status'=>1,
            'message'=>'Staff created',
            'data'=>$staff
        ];

        }catch(\Exception $e){

        return [
            'status'=>0,
            'message'=>$e->getMessage()
        ];

        }
    }



    public function update(Request $request)
    {
        try{

        $staff = User::find($request->id);

        $staff->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role'=>$request->role,
            'outlet_id'=>$request->branch_id
        ]);

        return [
            'status'=>1,
            'message'=>'Staff updated'
        ];

        }catch(\Exception $e){

        return [
            'status'=>0,
            'message'=>$e->getMessage()
        ];

        }
    }



    public function delete(Request $request)
    {
        try{

        User::where('id',$request->id)->delete();

        return [
            'status'=>1,
            'message'=>'Staff deleted'
        ];

        }catch(\Exception $e){

        return [
            'status'=>0,
            'message'=>$e->getMessage()
        ];

        }
    }

}
