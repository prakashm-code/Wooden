<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EnquiryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlockBoard;
use App\Models\Customer;
use App\Models\Door;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Outlet;
use App\Models\Payment;
use App\Models\Plywood;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $page = 'admin.dashboard';

        $total_plywoods = Plywood::count();
        $total_doors = Door::count();
        $total_blockboards = BlockBoard::count();

        $total_enquiry = Enquiry::count();
        return view("layouts.layout", compact(
            'title',
            'page',
            'total_plywoods',
            'total_doors',
            'total_blockboards',
            'total_enquiry',

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
