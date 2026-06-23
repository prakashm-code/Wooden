<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Outlet;
use App\Models\Payment;
use App\Models\Table;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class ReportController extends Controller
{
public function orderReport(Request $request)
{
    try {
        $query = $this->orderFilter($request);

        $perPage = $request->per_page ?? 10;

        $data = $query
            ->leftJoin('payments', 'orders.id', '=', 'payments.order_id')
            ->leftJoin('payment_methods', 'payments.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw("
                DATE(orders.created_at) as date,

                COUNT(DISTINCT orders.id) as total_orders,

                SUM(orders.order_session='lunch') as lunch_orders,
                SUM(orders.order_session='dinner') as dinner_orders,

                SUM(orders.order_type='dine_in') as dinein_orders,
                SUM(orders.order_type='parcel') as parcel_orders,

                SUM(orders.grand_total) as total_payment
            ")
            ->groupBy('date')
            ->orderBy($request->sort ?? 'date', $request->order ?? 'desc')
            ->paginate($perPage);

        // 🔥 Add payment method array manually (clean & correct way)
      $data->getCollection()->transform(function ($row) use ($request) {

    $paymentQuery = Order::query()
        ->leftJoin('payments', 'orders.id', '=', 'payments.order_id')
        ->leftJoin('payment_methods', 'payments.payment_method_id', '=', 'payment_methods.id');

    // apply SAME filters again (important)
    if ($request->branch_id) {
        $paymentQuery->where('orders.outlet_id', $request->branch_id);
    }

    if ($request->start_date && $request->end_date) {
        $paymentQuery->whereBetween('orders.created_at', [
            Carbon::parse($request->start_date)->startOfDay(),
            Carbon::parse($request->end_date)->endOfDay(),
        ]);
    }

    // filter per date
    $paymentQuery->whereDate('orders.created_at', $row->date);

    $payments = $paymentQuery
        ->selectRaw("
            payment_methods.name as method,
            SUM(payments.amount) as amount
        ")
        ->groupBy('payment_methods.name')
        ->get();

    $row->payment_methods = $payments;

    return $row;
});

        return response()->json([
            'status' => 1,
            'message' => 'Order report',
            'data' => $data
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 0,
            'message' => $e->getMessage()
        ]);
    }
}
    private function orderFilter(Request $request)
    {
        $query = Order::query();

        if ($request->branch_id) {
            $query->where('outlet_id', $request->branch_id);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('orders.created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }

        if ($request->search) {
            $query->where('order_number', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->order_type) {
            $query->where('order_type', $request->order_type); // 'dine_in' or 'parcel'
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        return $query;
    }
    public function orderListReport(Request $request)
    {
        try {
            $perPage = $request->per_page ?? 10;

            $query = Order::with([
                'customer',
                'orderStaff',
                'payments.method',
                'taxes.tax',
                'items.thali',
                'branch'
            ]);
            // dd(1);
            // Filters
            if ($request->branch_id) {
                $query->where('outlet_id', $request->branch_id);
            }

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [
                    Carbon::parse($request->start_date)->startOfDay(),
                    Carbon::parse($request->end_date)->endOfDay(),
                ]);
            }

            if ($request->search) {
                $query->where('order_number', 'LIKE', '%' . $request->search . '%');
            }

            if ($request->order_type) {
                $query->where('order_type', $request->order_type);
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->customer_id) {
                $query->where('customer_id', $request->customer_id);
            }

            if ($request->meal_type) {
                $query->where('order_session', $request->meal_type);
            }

            // Sort map
            $sortMap = [
                'date'         => 'created_at',
                'grand_total'  => 'grand_total',
                'order_number' => 'order_number',
                'status'       => 'status',
                'created_at'   => 'created_at',
            ];

            $sortColumn = $sortMap[$request->sort] ?? 'created_at';
            $sortDir    = in_array($request->order, ['asc', 'desc']) ? $request->order : 'desc';

            $orders = $query->orderBy($sortColumn, $sortDir)->paginate($perPage);

            $data = $orders->map(function ($order) {
                $payment      = $order->payments->first();
                $taxBreakdown = $order->taxes->mapWithKeys(function ($tax) {
                    return [$tax->tax->name ?? 'Tax' => $tax->tax_amount ?? ''];
                });

                $items = $order->items->map(function ($item) {
                    return [
                        'name'          => $item->thali->name    ?? '',
                        'qty'           => $item->quantity       ?? '',
                        'price'         => $item->price          ?? '',
                        'total'         => $item->total          ?? '',
                        'type'          => $item->order_type     ?? '',
                        'parcel_charge' => $item->parcel_charge  ?? '',
                    ];
                });

                return [
                    'id'             => $order->order_number          ?? '',
                    'created_at'     => $order->created_at            ?? '',
                    'branch_id'      => $order->outlet_id             ?? '',
                    'branch_name'    => $order->branch->name          ?? '',
                    'staff_name'     => $order->orderStaff->name      ?? '',
                    'customer_name'  => $order->customer->name        ?? '',
                    'customer_phone' => $order->customer->phone       ?? '',
                    'order_type'     => $order->order_type            ?? '',
                    'meal_type'      => $order->order_session         ?? '',
                    'status'         => $order->status                ?? '',
                    'table_number'   => $order->table_number          ?? '',
                    'payment_type' => $order->payments->first()->method->name ?? '',
                    'tax_breakdown'  => $taxBreakdown,
                    'parcel_charge'  => $order->parcel_charge         ?? '',
                    'discount'       => $order->discount              ?? '',
                    'subtotal'       => $order->subtotal              ?? '',
                    'tax_total'      => $order->tax_total             ?? '',
                    'grand_total'    => $order->grand_total           ?? '',
                    'items'          => $items,
                ];
            });

            return response()->json([
                'status'  => 1,
                'message' => 'Order list',
                'data'    => $data,
                'meta'    => [
                    'total'        => $orders->total(),
                    'per_page'     => $orders->perPage(),
                    'current_page' => $orders->currentPage(),
                    'last_page'    => $orders->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 0,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function orderList(Request $request) {}
    public function transactionReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            $data = $query->with('customer')
                ->select(
                    'id',
                    'order_number',
                    'customer_id',
                    'order_type',
                    'grand_total',
                    'created_at'
                )
                ->orderBy($request->sort ?? 'created_at', $request->order ?? 'desc')
                ->paginate($request->per_page ?? 10);

            return [
                'status' => 1,
                'message' => 'Transaction report',
                'data' => $data
            ];
        } catch (\Exception $e) {

            return [
                'status' => 0,
                'message' => $e->getMessage()
            ];
        }
    }

    public function paymentReport(Request $request)
    {
        //         start_date
        // end_date
        // branch_id
        // sort
        // order
        // per_page
        try {

            $query = Payment::query()->with('method');

            if ($request->branch_id) {
                $query->whereHas('order', function ($q) use ($request) {
                    $q->where('outlet_id', $request->branch_id);
                });
            }

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [
                    $request->start_date,
                    $request->end_date
                ]);
            }

            $perPage = $request->per_page ?? 10;

            $data = $query->selectRaw("
                DATE(created_at) as date,
                payment_method_id,
                SUM(amount) total_amount
            ")
                ->groupBy('date', 'payment_method_id')
                ->orderBy($request->sort ?? 'date', $request->order ?? 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => 1,
                'message' => 'Payment report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function staffOrderReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            $perPage = $request->per_page ?? 10;

            $data = $query->with('orderStaff')
                ->selectRaw("
                    order_staff_id,
                    COUNT(*) as total_orders
                ")
                ->groupBy('order_staff_id')
                ->orderBy($request->sort ?? 'total_orders', $request->order ?? 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => 1,
                'message' => 'Staff order report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
   public function billingStaffReport(Request $request)
{
    try {
        $perPage = $request->per_page ?? 10;

        $sortMap = [
            'total_orders'     => 'total_orders',
            'billing_staff_id' => 'billing_staff_id',
        ];
        $sortColumn = $sortMap[$request->sort] ?? 'total_orders';
        $sortDir    = in_array($request->order, ['asc', 'desc']) ? $request->order : 'desc';

        $orders = $this->orderFilter($request)
            ->with('billingStaff')
            ->selectRaw("
                billing_staff_id,
                COUNT(*) AS total_orders
            ")
            ->groupBy('billing_staff_id')
            ->orderBy($sortColumn, $sortDir)
            ->paginate($perPage);

        $data = $orders->map(function ($row) {
            return [
                'staff_id'     => $row->billing_staff_id,
                'staff_name'   => $row->billingStaff->name  ?? '-',
                'staff_phone'  => $row->billingStaff->phone ?? '-',
                'total_orders' => (int) $row->total_orders,
            ];
        });

        return response()->json([
            'status'  => 1,
            'message' => 'Billing staff report',
            'data'    => $data,
            'meta'    => [
                'total'        => $orders->total(),
                'per_page'     => $orders->perPage(),
                'current_page' => $orders->currentPage(),
                'last_page'    => $orders->lastPage(),
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 0,
            'message' => $e->getMessage()
        ], 500);
    }
}
    public function gstOrderReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            $perPage = $request->per_page ?? 10;

            $data = $query->select(
                'order_number',
                // 'total_guest',
                // 'total_items',
                'subtotal',
                'cgst',
                'sgst',
                'tax_total',
                'grand_total',
                'created_at'
            )
                ->orderBy($request->sort ?? 'created_at', $request->order ?? 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => 1,
                'message' => 'GST order report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function gstDateReport(Request $request)
{
    try {
        $perPage = $request->per_page ?? 10;

        $sortMap = [
            'date'         => 'date',
            'before_tax'   => 'before_tax',
            'cgst'         => 'cgst',
            'sgst'         => 'sgst',
            'total_tax'    => 'total_tax',
            'total_amount' => 'total_amount',
        ];
        $sortColumn = $sortMap[$request->sort] ?? 'date';
        $sortDir    = in_array($request->order, ['asc', 'desc']) ? $request->order : 'desc';

        $orders = $this->orderFilter($request)
            ->selectRaw("
                DATE(created_at) AS date,
                SUM(subtotal)    AS before_tax,
                SUM(cgst)        AS cgst,
                SUM(sgst)        AS sgst,
                SUM(tax_total)   AS total_tax,
                SUM(grand_total) AS total_amount
            ")
            ->groupBy('date')
            ->orderBy($sortColumn, $sortDir)
            ->paginate($perPage);

        $data = $orders->map(function ($row) {
            return [
                'date'         => $row->date,
                'before_tax'   => $row->before_tax,
                'cgst'         => $row->cgst,
                'sgst'         => $row->sgst,
                'total_tax'    => $row->total_tax,
                'total_amount' => $row->total_amount,
            ];
        });

        return response()->json([
            'status'  => 1,
            'message' => 'GST date report',
            'data'    => $data,
            'meta'    => [
                'total'        => $orders->total(),
                'per_page'     => $orders->perPage(),
                'current_page' => $orders->currentPage(),
                'last_page'    => $orders->lastPage(),
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 0,
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function branchStaffReport(Request $request)
    {
        try {

            $data = Outlet::selectRaw("
                id,
                name as branch_name
            ")
                ->withCount('staff')
                ->paginate($request->per_page ?? 10);

            return response()->json([
                'status' => 1,
                'message' => 'Branch staff report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function customerReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            $perPage = $request->per_page ?? 10;

            $sortColumn = $request->sort ?? 'total_payment';

            $sortable = [
                'id' => 'orders.customer_id',
                'customer_name' => 'customers.name',
                'total_orders' => 'total_orders',
                'total_payment' => 'total_payment',
            ];

            $sortColumn = $sortable[$sortColumn] ?? 'total_payment';

            $data = $query
                ->join('customers', 'customers.id', '=', 'orders.customer_id')
                ->selectRaw("
                orders.customer_id,
                customers.name as customer_name,
                COUNT(orders.id) as total_orders,
                SUM(CASE WHEN order_session = 'lunch' THEN 1 ELSE 0 END) as lunch_orders,
                SUM(CASE WHEN order_session = 'dinner' THEN 1 ELSE 0 END) as dinner_orders,
                SUM(orders.tax_total) as total_tax,
                SUM(orders.grand_total) as total_payment
            ")
                ->groupBy('orders.customer_id', 'customers.name')
                ->orderBy($sortColumn, $request->order ?? 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => 1,
                'message' => 'Customer report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function branchSalesReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            $perPage = $request->per_page ?? 10;

            $data = $query->with('branch')
                ->selectRaw("
                outlet_id,
                SUM(order_session='lunch') total_lunch_order,
                SUM(order_session='dinner') total_dinner_order,
                SUM(subtotal) amount_before_tax,
                SUM(cgst) total_tax,
                SUM(grand_total) total_payment
            ")
                ->groupBy('outlet_id')
                ->orderBy($request->sort ?? 'total_payment', $request->order ?? 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => 1,
                'message' => 'Branch sales report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function totalSalesReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            /* ---------------- ORDER BREAKDOWN ---------------- */

            $orders = (clone $query)
                ->selectRaw("
                COUNT(*) as total_orders,
                SUM(CASE WHEN order_session = 'lunch' THEN 1 ELSE 0 END) as lunch_orders,
                SUM(CASE WHEN order_session = 'dinner' THEN 1 ELSE 0 END) as dinner_orders,
                SUM(CASE WHEN order_type = 'parcel' THEN 1 ELSE 0 END) as parcel_orders,
                SUM(CASE WHEN order_type = 'dine_in' THEN 1 ELSE 0 END) as dinein_orders
            ")
                ->first();

            /* ---------------- PAYMENT BREAKDOWN ---------------- */

            $payments = (clone $query)
                ->join('payments', 'payments.order_id', '=', 'orders.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
                ->selectRaw("
                payment_methods.name as payment_method,
                SUM(payments.amount) as total
            ")
                ->groupBy('payment_methods.name')
                ->get();

            /* ---------------- TAX BREAKDOWN ---------------- */

            $taxes = (clone $query)
                ->join('order_taxes', 'order_taxes.order_id', '=', 'orders.id')
                ->join('tax_types', 'tax_types.id', '=', 'order_taxes.tax_id')
                ->selectRaw("
                tax_types.name as tax_name,
                SUM(order_taxes.tax_amount) as total
            ")
                ->groupBy('tax_types.name')
                ->get();

            /* ---------------- RESPONSE ---------------- */

            return response()->json([
                'status' => 1,
                'message' => 'Total sales report',
                'data' => [
                    'orders' => $orders,
                    'payments' => $payments,
                    'taxes' => $taxes
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function dashboard(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            /* ---------------- MAIN STATS ---------------- */

            $stats = (clone $query)
                ->selectRaw("
                COUNT(orders.id) as total_orders,
                SUM(orders.grand_total) as total_sales,
                SUM(orders.tax_total) as total_tax,
                COUNT(DISTINCT orders.customer_id) as total_customers
            ")
                ->first();

            /* ---------------- SESSION BREAKDOWN ---------------- */

            $sessions = (clone $query)
                ->selectRaw("
                SUM(CASE WHEN order_session = 'lunch' THEN 1 ELSE 0 END) as lunch_orders,
                SUM(CASE WHEN order_session = 'dinner' THEN 1 ELSE 0 END) as dinner_orders
            ")
                ->first();

            /* ---------------- ORDER TYPE ---------------- */

            $types = (clone $query)
                ->selectRaw("
                SUM(CASE WHEN order_type = 'dine_in' THEN 1 ELSE 0 END) as dine_in,
                SUM(CASE WHEN order_type = 'parcel' THEN 1 ELSE 0 END) as parcel
            ")
                ->first();

            /* ---------------- PAYMENT BREAKDOWN ---------------- */

            $payments = (clone $query)
                ->join('payments', 'payments.order_id', '=', 'orders.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'payments.payment_method_id')
                ->selectRaw("
                payment_methods.name as payment_method,
                SUM(payments.amount) as total
            ")
                ->groupBy('payment_methods.name')
                ->get();

            /* ---------------- RECENT ORDERS ---------------- */

            $recentOrders = (clone $query)
                ->with('customer:id,name')
                ->select('orders.id', 'orders.order_number', 'orders.customer_id', 'orders.grand_total', 'orders.created_at')
                ->latest('orders.created_at')
                ->limit(5)
                ->get();

            return response()->json([
                'status' => 1,
                'message' => 'Dashboard data',
                'data' => [

                    'stats' => $stats,

                    'sessions' => $sessions,

                    'order_types' => $types,

                    'payments' => $payments,

                    'recent_orders' => $recentOrders

                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function orderGstReport(Request $request)
    {
        try {

            $query = $this->orderFilter($request);

            $perPage = $request->per_page ?? 10;

            $data = $query
                ->join('order_taxes', 'order_taxes.order_id', '=', 'orders.id')
                ->join('tax_types', 'tax_types.id', '=', 'order_taxes.tax_id')
                ->selectRaw("
                orders.id,
                orders.order_number,
                orders.created_at,
                tax_types.name as tax_name,
                order_taxes.tax_percentage,
                order_taxes.tax_amount
            ")
                ->orderBy($request->sort ?? 'orders.created_at', $request->order ?? 'desc')
                ->paginate($perPage);

            return response()->json([
                'status' => 1,
                'message' => 'Order GST report',
                'data' => $data
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function branchTableStatus(Request $request)
{
    try {
        // ✅ branch_id is compulsory
        if (!$request->branch_id) {
            return response()->json([
                'status'  => 0,
                'message' => 'branch_id is required'
            ], 422);
        }

        $tables = Table::where('outlet_id', $request->branch_id)
            ->with([
                'orders' => function ($q) {
                    $q->whereIn('status', ['pending', 'occupied'])
                      ->with([
                          'customer',
                          'orderStaff',
                          'items.thali',
                      ])
                      ->latest();
                }
            ])
            ->get();

        $data = $tables->map(function ($table) {

            $activeOrder = $table->orders->first();

            return [
                'table_id'      => $table->id,
                'table_number'  => $table->table_number,
                'capacity'      => $table->capacity      ?? '-',
                'is_occupied'   => $activeOrder ? true : false,
                'order'         => $activeOrder ? [
                    'order_id'       => $activeOrder->id,
                    'order_number'   => $activeOrder->order_number,
                    'status'         => $activeOrder->status,
                    'order_type'     => $activeOrder->order_type,
                    'order_session'  => $activeOrder->order_session,
                    'customer_name'  => $activeOrder->customer->name  ?? '-',
                    'customer_phone' => $activeOrder->customer->phone ?? '-',
                    'staff_name'     => $activeOrder->orderStaff->name ?? '-',
                    'subtotal'       => $activeOrder->subtotal,
                    'grand_total'    => $activeOrder->grand_total,
                    'created_at'     => $activeOrder->created_at,
                    'items'          => $activeOrder->items->map(function ($item) {
                        return [
                            'name'     => $item->thali->name ?? '-',
                            'qty'      => $item->quantity,
                            'price'    => $item->price,
                            'total'    => $item->total,
                            'type'     => $item->order_type,
                        ];
                    }),
                ] : null,
            ];
        });

        // ✅ summary counts
        $totalTables    = $tables->count();
        $occupiedTables = $data->where('is_occupied', true)->count();
        $freeTables     = $totalTables - $occupiedTables;

        return response()->json([
            'status'  => 1,
            'message' => 'Branch table status',
            'summary' => [
                'total_tables'    => $totalTables,
                'occupied_tables' => $occupiedTables,
                'free_tables'     => $freeTables,
            ],
            'data' => $data,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status'  => 0,
            'message' => $e->getMessage()
        ], 500);
    }
}

//     public function customerReport(Request $request)
// {
//     try {
//         $perPage = $request->per_page ?? 10;

//         $query = Order::with(['customer', 'branch'])
//             ->selectRaw("
//                 customer_id,
//                 outlet_id,
//                 COUNT(*)           AS total_orders,
//                 SUM(grand_total)   AS total_payment
//             ")
//             ->groupBy('customer_id', 'outlet_id');

//         // Role filter
//         if (auth()->user()->role !== 'super_admin') {
//             $query->where('outlet_id', auth()->user()->outlet_id);
//         }

//         // Branch filter (super_admin only)
//         if ($request->branch_id) {
//             $query->where('outlet_id', $request->branch_id);
//         }

//         // Date filter
//         if ($request->start_date && $request->end_date) {
//             $query->whereBetween('created_at', [
//                 $request->start_date . ' 00:00:00',
//                 $request->end_date   . ' 23:59:59',
//             ]);
//         }

//         // Search by customer name
//         if ($request->search) {
//             $query->whereHas('customer', function ($q) use ($request) {
//                 $q->where('name',  'LIKE', '%' . $request->search . '%')
//                   ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
//             });
//         }

//         // Sort
//         $sortMap = [
//             'total_orders'  => 'total_orders',
//             'total_payment' => 'total_payment',
//             'customer_id'   => 'customer_id',
//         ];
//         $sortColumn = $sortMap[$request->sort] ?? 'customer_id';
//         $sortDir    = in_array($request->order, ['asc', 'desc']) ? $request->order : 'desc';

//         $orders = $query->orderBy($sortColumn, $sortDir)
//                         ->paginate($perPage);

//         $data = $orders->map(function ($row) {
//             return [
//                 'customer_id'    => $row->customer_id,
//                 'customer_name'  => $row->customer->name  ?? '-',
//                 'customer_phone' => $row->customer->phone ?? '-',
//                 'branch_id'      => $row->outlet_id,
//                 'branch_name'    => $row->branch->name    ?? '-',
//                 'total_orders'   => (int) $row->total_orders,
//                 'total_payment'  => $row->total_payment,
//             ];
//         });

//         return response()->json([
//             'status'  => 1,
//             'message' => 'Customer report',
//             'data'    => $data,
//             'meta'    => [
//                 'total'        => $orders->total(),
//                 'per_page'     => $orders->perPage(),
//                 'current_page' => $orders->currentPage(),
//                 'last_page'    => $orders->lastPage(),
//             ]
//         ]);

//     } catch (\Exception $e) {
//         return response()->json([
//             'status'  => 0,
//             'message' => $e->getMessage()
//         ], 500);
//     }
// }
}
