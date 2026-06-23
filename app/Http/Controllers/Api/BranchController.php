<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Setting;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    public function index()
    {
        $outlets=Outlet::all();
         return response()->json([
                'status'  => 1,
                'data'=>$outlets,
                'message' => 'Outlets list',
            ]);
    }


   public function list(Request $request)
    {
        try{

        $query = Outlet::query();
        // dd($query);

        if($request->search){
            $query->where('name','LIKE','%'.$request->search.'%');
        }

        $data = $query
            ->orderBy($request->sort ?? 'id',$request->order ?? 'desc')->get();
            // ->paginate($request->per_page ?? 10);

        return [
            'status'=>1,
            'message'=>'Branch list',
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

        $outlet = Outlet::create([
            'name'=>$request->name,
            'city'=>$request->city,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
     $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'admin';
            $user->outlet_id = $outlet->id;
            $user->save();

            $setting = new Setting();
            $setting->outlet_id = $outlet->id;
            $setting->total_tables = 1;
            $setting->gst_percentage = 0;
            $setting->parcel_charge_per_item = 10;
            $setting->save();
            for ($i = 1; $i <= 10; $i++) {
                $table = new Table();
                $table->outlet_id = $outlet->id;
                $table->table_number = $i;
                $table->save();
            }
        return [
            'status'=>1,
            'message'=>'outlet created',
            'data'=>$outlet
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

        $branch = Outlet::find($request->id);

        $branch->update([
            'name'=>$request->name,
            'city'=>$request->city,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'email'=>$request->email
        ]);

        return [
            'status'=>1,
            'message'=>'Branch updated'
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

        Outlet::where('id',$request->id)->delete();

        return [
            'status'=>1,
            'message'=>'Branch deleted'
        ];

        }catch(\Exception $e){

        return [
            'status'=>0,
            'message'=>$e->getMessage()
        ];

        }
    }
}
