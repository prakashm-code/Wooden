<?php

namespace App\DataTables;

use App\Models\BlockBoard;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlockBoardDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<BlockBoard> $query Results from query() method.
     */
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
                    if ($keyword !== '') {
                        $keywords = explode(' ', $keyword);

                        $query->where(function ($q) use ($keywords, $keyword) {
                            $q->where('name', 'LIKE', "%{$keyword}%");
                            $q->orWhere('price', 'LIKE', "%{$keyword}%");
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
            ->addColumn('price', function ($row) {
                return '₹ ' . $row->price;
            })

            ->addColumn('status', function ($row) {
                $checked = $row->is_active == 1 ? 'checked' : '';
                return '  <div class="form-check form-switch">
        <input class="form-check-input status-toggle" type="checkbox" id="color-primary" data-id="' . $row->id . '"  ' . $checked . '>
    </div>';
            })
            ->addColumn('actions', function ($row) {
                $cryptId = encrypt($row->id);
                $template_delete = decrypt($cryptId);
                $delete_url = route('BlockBoard.destroy', $cryptId);
                $edit_url = route('BlockBoard.edit', $cryptId);

                return '<div class="action-icon" style="gap: 10px;display: flex">
                                                          <a class="dropdown-item"  href="' .  $edit_url . '"><i class="icon-base bx bx-edit-alt me-2"></i></a>
                                                       <a href="javascript:void(0);"class="dropdown-item delete-link"data-url="' . $delete_url . '"title="Delete"> <i class="icon-base bx bx-trash me-2"></i></a>

                            </div>';
            })

            ->rawColumns(['checkbox', 'name', 'price', 'status', 'actions']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<BlockBoard>
     */
    public function query(BlockBoard $model, Request $request): QueryBuilder
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'price',
        ];

        $orderIndex = $request->input('order.0.column', 0);
        $column = $columns[$orderIndex] ?? 'id';


        $direction = 'desc';

        if (isset($request->order[0]['dir']) && $request->order[0]['dir'] == 'asc') {
            $direction = 'asc';
        }

        return BlockBoard::query()->orderBy($column, $direction);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('BlockBoard-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('no')->title('No')->orderable(false),
            Column::make('name')->orderable(true),
            Column::make('price')->title('Price')->orderable(true),
            // Column::make('status')->title('Status')->orderable(false),
            Column::make('actions')->title('Actions')->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BlockBoard_' . date('YmdHis');
    }
}
