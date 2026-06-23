<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EnquiryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Outlet;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $page = 'admin.dashboard';

        // $user = auth()->user();
        $today = Carbon::today();

        // Base query
        // $orderQuery = Order::query();
        // $paymentQuery = Payment::query();

        // // If admin → only their outlet
        // if ($user->role == 'admin') {

        //     $orderQuery->where('outlet_id', $user->outlet_id);

        //     $paymentQuery->whereHas('order', function ($q) use ($user) {
        //         $q->where('outlet_id', $user->outlet_id);
        //     });
        // }

        // Today's Orders
        $todayOrders = 1;

        // Today's Sales
        $todaySales = 1;

        // Today's Payments
        $todayPayments = 1;

        // Customers
        $totalCustomers = 1;

        // Staff
        $totalStaff = User::whereIn('role', ['admin', 'cashier', 'waiter'])->count();
        $totalRevenue = 11111;
        // Recent Orders


        // dd($recentOrders);
        $totalOutlets = 1;
        $totalOrders = 1;
        $outlets = 1;
        $activeStaff = User::where('role', '!=', 'super_admin')->count();
        return view("layouts.layout", compact(
            'title',
            'page',
            'totalRevenue',
            'todayOrders',
            'totalOrders',
            'totalOutlets',
            'todaySales',
            'todayPayments',
            'totalCustomers',
            'totalStaff',
            'outlets',
        ));
    }



    public function enquiry(EnquiryDataTable $DataTable)
    {
        $title = 'Enquiry List';
        $page = 'admin.enquiry.list';
        $js = ['validate'];


        return $DataTable->render('layouts.layout', compact('title', 'page', 'js'));
    }




    // ── HELPER ──



}
