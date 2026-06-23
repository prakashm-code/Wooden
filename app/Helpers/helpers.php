<?php

use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Setting;
use App\Models\Table;
use App\Models\TaxType;
use App\Models\Thali;
use Carbon\Carbon;

function getThaliWithItems()
{
    return Thali::get();
}

function settings()
{
    return Setting::first();
}

function parcelPrice(){
    return Setting::where('outlet_id',auth()->user()->outlet_id)->select('parcel_charge_per_item')->first()->parcel_charge_per_item??0;
}
function getOrderSession()
{
    $now = Carbon::now('Asia/Kolkata')->format('H:i');

    if ($now >= '11:00' && $now <= '16:59') {
        return 'lunch';
    }

    return 'dinner';
}
function branchFilter($query)
{
    if (auth()->user()->role != 'super_admin') {

        $query->where('outlet_id', auth()->user()->outlet_id);
    }

    return $query;
}

function gst_data(){
    return TaxType::where('status',1)->get();
}

function getTable( $outletId)
{
    return Table::where('outlet_id', $outletId)->count();
}

function getPaymentMethod()
{
    return PaymentMethod::all();
}