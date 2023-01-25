<?php

namespace App\Http\Controllers;

use App\DataTables\StockHistoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStockHistoryRequest;
use App\Http\Requests\UpdateStockHistoryRequest;
use App\Repositories\StockHistoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\User;

class StockHistoryController extends AppBaseController
{
    /** @var StockHistoryRepository $stockHistoryRepository*/
    private $stockHistoryRepository;

    public function __construct(StockHistoryRepository $stockHistoryRepo)
    {
        $this->stockHistoryRepository = $stockHistoryRepo;
    }

    /**
     * Display a listing of the StockHistory.
     *
     * @param StockHistoryDataTable $stockHistoryDataTable
     *
     * @return Response
     */
    public function index(StockHistoryDataTable $stockHistoryDataTable)
    {
        return $stockHistoryDataTable->render('stock_histories.index');
    }

    /**
     * Show the form for creating a new StockHistory.
     *
     * @return Response
     */
    public function create()
    {
        $user =      User::pluck('name','id');

        return view('stock_histories.create')->with('user',$user);
    }

    /**
     * Store a newly created StockHistory in storage.
     *
     * @param CreateStockHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreateStockHistoryRequest $request)
    {
        $input = $request->all();

        $stockHistory = $this->stockHistoryRepository->create($input);

        Flash::success('Stock History saved successfully.');

        return redirect(route('stockHistories.index'));
    }

    /**
     * Display the specified StockHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        return view('stock_histories.show')->with('stockHistory', $stockHistory);
    }

    /**
     * Show the form for editing the specified StockHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        return view('stock_histories.edit')->with('stockHistory', $stockHistory);
    }

    /**
     * Update the specified StockHistory in storage.
     *
     * @param int $id
     * @param UpdateStockHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockHistoryRequest $request)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        $stockHistory = $this->stockHistoryRepository->update($request->all(), $id);

        Flash::success('Stock History updated successfully.');

        return redirect(route('stockHistories.index'));
    }

    /**
     * Remove the specified StockHistory from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            Flash::error('Stock History not found');

            return redirect(route('stockHistories.index'));
        }

        $this->stockHistoryRepository->delete($id);

        Flash::success('Stock History deleted successfully.');

        return redirect(route('stockHistories.index'));
    }
}
