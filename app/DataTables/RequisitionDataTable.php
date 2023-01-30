<?php

namespace App\DataTables;

use App\Models\Item;
use App\Models\Requisition;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Models\User;


class RequisitionDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'requisitions.datatables_actions')
        ->editColumn('item_name', function($requisition){
            return Item::find($requisition->item_name)->name;
            // '  '.Item::find($requisition->item_name)->category;
        })
        ->editColumn('user', function($requisition){
            return User::find($requisition->user)->name;
        })
        ->editColumn( 'status',function($requisition){
            if($requisition->status == 'pending'){
                return '<span class="badge bg-warning">Pending</span>';
            }elseif($requisition->status == 'approved'){
                return '<span class="badge bg-success">Approved</span>
                ';
            }elseif($requisition->status == 'declined'){
                return '<span class="badge bg-danger">Declined</span>';
            }
        })
        ->rawColumns(['status' , 'action'])
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Requisition $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Requisition $model)
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
            'user',
            'item_name',
            'qty_requested',
            'msg',
            'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'requisitions_datatable_' . time();
    }
}
