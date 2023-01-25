<?php

namespace App\DataTables;

use App\Models\StockHistory;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Models\User;

class StockHistoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'stock_histories.datatables_actions')
        ->editColumn('category_name', function($stock_history){
            return \App\Models\Category::find($stock_history->category_name)->name;
        })
        ->editColumn('item_name', function($stock_history){
            return \App\Models\Item::find($stock_history->item_name)->name;
        })
        ->editColumn('user', function($stock_history){
            return User::find($stock_history->user)->name;
        })
        ->editColumn( 'type',function($stock_history){
            if($stock_history->type == 'Initial stock'){
                return '<span class="badge bg-warning"">Initial stock</span>';
            }elseif($stock_history->type == 'Restock'){
                return '<span class="badge bg-success">Restock</span>
                ';
            }
        })
        ->rawColumns(['type' , 'action'])
        ;
    }




    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StockHistory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StockHistory $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'user' ,
            'item_name',
            'category_name',
            'quantity',
            'type',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stock_histories_datatable_' . time();
    }
}
