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

            ->addColumn('actions', function ($row) {
                $cryptId = encrypt($row->id);
                $deleteUrl = route('enquiry.destroy', $cryptId);

                return '
                    <div class="d-flex gap-2">
                        <a href="javascript:void(0)"
                           class="delete-link"
                           data-url="' . $deleteUrl . '"
                           title="Delete">
                            <i class="bx bx-trash"></i>
                        </a>
                    </div>
                ';
            })

            ->rawColumns(['actions']);
    }

    public function query(Enquiry $model, Request $request): QueryBuilder
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'phone_number',
            3 => 'email',
            4 => 'state',
            5 => 'city',
            6 => 'product',
            7 => 'created_at',
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
            ->orderBy(7, 'desc');
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

            Column::make('state')
                ->title('State'),

            Column::make('city')
                ->title('City'),

            Column::make('product')
                ->title('Product'),

            Column::make('message')
                ->title('Message')
                ->orderable(false),

            Column::make('created_at')
                ->title('Date'),

            Column::computed('actions')
                ->title('Actions')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Enquiry_' . date('YmdHis');
    }
}
