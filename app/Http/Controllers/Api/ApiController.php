<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderTaxes;
use App\Models\Payment;
use App\Models\TaxType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
public function customer_list(Request $request)
{
    try {
        $query = Customer::query()
            ->withCount('orders')
            ->withSum('orders', 'grand_total');


// dd(Customer::whereHas('orders', fn($q) => $q->where('outlet_id', $request->branch_id))->count());


        if ($request->branch_id) {
            // ✅ whereHas filters the customer list to only those with orders in this branch
            $query->whereHas('orders', function ($q) use ($request) {
                $q->where('outlet_id', $request->branch_id);
            });

            // ✅ also scope counts and sums to this branch only
            $query->withCount(['orders' => fn($q) => $q->where('outlet_id', $request->branch_id)])
                  ->withSum(['orders' => fn($q) => $q->where('outlet_id', $request->branch_id)], 'grand_total');
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name',  'LIKE', '%' . $request->search . '%')
                  ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
            });
        }

        $data = $query
            ->orderBy($request->sort ?? 'id', $request->order ?? 'desc')
            ->paginate($request->per_page ?? 10);

        return response()->json([
            'status'  => 1,
            'message' => 'Customer list',
            'data'    => $data
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 0,
            'message' => $e->getMessage()
        ]);
    }
}
    public function completeOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'payment_method_id' => 'required',
            'subtotal' => 'required|numeric',
            'tax_total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'grand_total' => 'required|numeric',
        ]);


        DB::beginTransaction();

        try {

            $customer = Customer::firstOrCreate(
                ['phone' => $request->customer_phone],
                [
                    'name' => $request->customer_name
                ]
            );

            $order = Order::findOrFail($request->order_id);
            $order->update([

                'customer_id' => $customer->id,

                'subtotal' => $request->subtotal,

                'tax_total' => $request->tax_total ?? 0,

                'discount' => $request->discount ?? 0,

                'grand_total' => $request->grand_total,

                'status' => 'completed'

            ]);

            Payment::create([
                'order_id' => $order->id,
                'payment_method_id' => $request->payment_method_id,
                'amount' => $request->grand_total
            ]);


            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Order completed successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }

        
    }
    public function viewOrders(Request $request)
{
   try {

    $query = Order::with([
        'table:id,table_number',
        'customer:id,name,phone',
        'orderStaff:id,name',
        'billingStaff:id,name',
        'items:id,order_id,thali_id,quantity,price,total'
    ])
    ->where('customer_id',$request->customer_id);

    if ($request->branch_id) {
        $query->where('outlet_id',$request->branch_id);
    }

    if ($request->search) {
        $query->where('order_number','LIKE','%'.$request->search.'%');
    }

    $orders = $query
        ->orderBy($request->sort ?? 'id', $request->order ?? 'desc')
        ->paginate($request->per_page ?? 10);


    $orders->getCollection()->transform(function ($order) {

        return [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'table' => $order->table->table_number ?? null,
            'customer' => $order->customer->name ?? null,
            // 'customer_email' => $order->customer->email ?? null,
            'customer_phone' => $order->customer->phone ?? null,
            'order_staff' => $order->orderStaff->name ?? null,
            'billing_staff' => $order->billingStaff->name ?? null,
            'order_type' => $order->order_type,
            'parcel_charge'=>$order->parcel_charge,
            'total_tax'=>OrderTaxes::where('order_id',$order->id)->sum('tax_percentage').'%',
            'total_tax_amt'=>$order->tax_total,
            'discount'=>$order->discount,
            'quantity' => $order->items->sum('quantity'),
            'price' => $order->items->price,
            'total' => $order->grand_total,
            'status' => $order->status,
            'grand_total' => $order->grand_total,
            'created_at' => $order->created_at->format('Y-m-d'),

        ];

    });

    return response()->json([
        'status' => 1,
        'message' => 'Customer orders',
        'data' => $orders
    ]);

} catch (\Exception $e) {

    return response()->json([
        'status' => 0,
        'message' => $e->getMessage()
    ]);
}
}

public function changePassword(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'old_password' => 'required',
        'password' => 'required|min:6',
    ]);

    $user = User::find($request->user_id);
    // dd($user);
    if (!Hash::check($request->old_password, $user->password)) {
        return response()->json([
            'status' => 0,
            'message' => 'Old password is incorrect'
        ], 200);
    }

    $user->update([
        'password' => Hash::make($request->password)
    ]);

    return response()->json([
        'status' => 1,
        'message' => 'Password changed successfully'
    ]);
}
}
