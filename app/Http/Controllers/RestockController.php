<?php

namespace App\Http\Controllers;

use App\DataTables\RestockDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRestockRequest;
use App\Http\Requests\UpdateRestockRequest;
use App\Repositories\RestockRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockHistory;
use Illuminate\Support\Facades\Auth;
use Response;

class RestockController extends AppBaseController
{
    /** @var RestockRepository $restockRepository*/
    private $restockRepository;

    public function __construct(RestockRepository $restockRepo)
    {
        $this->restockRepository = $restockRepo;
    }

    /**
     * Display a listing of the Restock.
     *
     * @param RestockDataTable $restockDataTable
     *
     * @return Response
     */
    public function index(RestockDataTable $restockDataTable)
    {
        return $restockDataTable->render('restocks.index');
    }

    /**
     * Show the form for creating a new Restock.
     *
     * @return Response
     */
    public function create()
    {

        $items = Item::pluck('name', 'id');
        // dd($items);
        return view('restocks.create')->with('items', $items);


    }

    /**
     * Store a newly created Restock in storage.
     *
     * @param CreateRestockRequest $request
     *
     * @return Response
     */
    public function store(CreateRestockRequest $request)
    {
        $input = $request->all();

        $restock = $this->restockRepository->create($input);

        //update stock quantity with restock quantity

        $stock = Stock::where('item_name', $restock->item_name)->first();
        $stock->quantity += $restock->restock_qty;
        $stock->save();

        //record in stock history
        $stockHistory = new StockHistory();
        $stockHistory->item_name = $restock->item_name;
        $stockHistory->quantity = $restock->restock_qty;
        $stockHistory->user = Auth::user()->id;;
        $stockHistory->category_name = $stock->category_name;
        $stockHistory->type = 'restock';
        $stockHistory->save();

        // // $stock = new Stock();
        // $stock = Stock::where('item_name', $restock->item_name);
        // $stock->quantity += $restock->restock_qty;
        // $stock->save();

        Flash::success('Restock saved successfully.');

        return redirect(route('restocks.index'));

        //update stock quantity with restock quantity





    }

    /**
     * Display the specified Restock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            Flash::error('Restock not found');

            return redirect(route('restocks.index'));
        }

        return view('restocks.show')->with('restock', $restock);
    }

    /**
     * Show the form for editing the specified Restock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            Flash::error('Restock not found');

            return redirect(route('restocks.index'));
        }

        return view('restocks.edit')->with('restock', $restock);
    }

    /**
     * Update the specified Restock in storage.
     *
     * @param int $id
     * @param UpdateRestockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRestockRequest $request)
    {
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            Flash::error('Restock not found');

            return redirect(route('restocks.index'));
        }

        $restock = $this->restockRepository->update($request->all(), $id);

        Flash::success('Restock updated successfully.');

        return redirect(route('restocks.index'));
    }

    /**
     * Remove the specified Restock from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            Flash::error('Restock not found');

            return redirect(route('restocks.index'));
        }

        $this->restockRepository->delete($id);

        Flash::success('Restock deleted successfully.');

        return redirect(route('restocks.index'));
    }
}
