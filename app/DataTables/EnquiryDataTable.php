<?php

namespace App\DataTables;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EnquiryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $counter = 1;

        return datatables()
            ->eloquent($query)

            ->addColumn('no', function () use (&$counter) {
                return $counter++;
            })

            ->filter(function ($query) {
                if ($this->request->has('search')) {
                    $keyword = trim($this->request->get('search')['value']);

                    if (!empty($keyword)) {
                        $query->where(function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', "%{$keyword}%")
                                ->orWhere('email', 'LIKE', "%{$keyword}%")
                                ->orWhere('phone_number', 'LIKE', "%{$keyword}%")
                                ->orWhere('state', 'LIKE', "%{$keyword}%")
                                ->orWhere('city', 'LIKE', "%{$keyword}%")
                                ->orWhere('product', 'LIKE', "%{$keyword}%");
                        });
                    }
                }
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="row-checkbox" value="' . $row->id . '">';
            })

            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('phone_number', function ($row) {
                return $row->phone_number;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('message', function ($row) {
                return $row->message;
            })
            ->addColumn('city', function ($row) {
                return $row->city;
            })

            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y');
            })



            ->rawColumns(['checkbox', 'name', 'phone_number', 'email', 'city', 'message', 'created_at']);
    }

    public function query(Enquiry $model, Request $request): QueryBuilder
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'phone_number',
            3 => 'email',
            4 => 'city',
            5 => 'message',
            6 => 'created_at',
        ];

        $orderIndex = $request->input('order.0.column', 0);
        $column = $columns[$orderIndex] ?? 'id';

        $direction = $request->input('order.0.dir', 'desc');

        return $model->newQuery()->orderBy($column, $direction);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('enquiry-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('no')
                ->title('No')
                ->orderable(false)
                ->searchable(false),

            Column::make('name')->title('Name'),

            Column::make('phone_number')
                ->title('Phone'),

            Column::make('email')
                ->title('Email'),


            Column::make('city')
                ->title('City'),

            Column::make('message')
                ->title('Message')
                ->orderable(false),

            Column::make('created_at')
                ->title('Date'),


        ];
    }

    protected function filename(): string
    {
        return 'Enquiry_' . date('YmdHis');
    }
}
