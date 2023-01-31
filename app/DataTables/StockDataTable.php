<?php

namespace App\DataTables;

use App\Models\Stock;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Models\Item;
use App\Models\Category;

class StockDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'stocks.datatables_actions')
        ->editColumn('item_name', function($stock){
            return \App\Models\Item::find($stock->item_name)->name;
        })
        ->editColumn('category_name', function($stock){
            return \App\Models\Category::find($stock->category_name)->name;
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stock $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Stock $model)
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
    $builder = $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax();
    if (auth()->user()->role == 'admin') {
        $builder->addAction(['width' => '120px', 'printable' => false]);
    }

    return $builder->parameters([
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
            'item_name',
            'category_name',
            'quantity',
            // 'date_added'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'stocks_datatable_' . time();
    }
}
