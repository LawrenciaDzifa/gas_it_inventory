<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Repositories\StockRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Item;
use App\Models\Category;
use App\Models\StockHistory;
use Illuminate\Support\Facades\Auth;

class StockController extends AppBaseController
{
    /** @var StockRepository $stockRepository*/
    private $stockRepository;

    public function __construct(StockRepository $stockRepo)
    {
        $this->stockRepository = $stockRepo;
    }

    /**
     * Display a listing of the Stock.
     *
     * @param StockDataTable $stockDataTable
     *
     * @return Response
     */
    public function index(StockDataTable $stockDataTable)
    {
        return $stockDataTable->render('stocks.index');
    }

    /**
     * Show the form for creating a new Stock.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin') {
            $items = Item::pluck('name','id');
            $categories = Category::pluck('name', 'id');
            return view('stocks.create')->with('categories',$categories)->with( 'items',$items);
        } else {
            return redirect()->back()->withErrors(['Only admin can access this page.']);
        }
    }


    /**
     * Store a newly created Stock in storage.
     *
     * @param CreateStockRequest $request
     *
     * @return Response
     */
    public function store(CreateStockRequest $request)
    {
        try {
            // code to insert new record
            $input = $request->all();
            $stock = $this->stockRepository->create($input);
            } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
            // error code for integrity constraint violation
            return back()->withErrors(['This item already has a stock record. You will rather have to Restock.'])->withInput();
            }
            }

            // other code

            return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');



        // Push record to Stock History Table
        $stockHistory = new StockHistory();
        $stockHistory->quantity = $stock->quantity;
        $stockHistory->user = Auth::user()->id;
        $stockHistory->category_name = $stock->category_name;
        $stockHistory->item_name = $stock->item_name;
        $stockHistory->save();

        Flash::success('Stock saved successfully.')->important();

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified Stock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found')->important();

            return redirect(route('stocks.index'));
        }

        return view('stocks.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified Stock.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stock = $this->stockRepository->find($id);
        $items = Item::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');



        if (empty($stock)) {
            Flash::error('Stock not found')->important();

            return redirect(route('stocks.index'));
        }

        return view('stocks.edit')->with('stock', $stock)->with('items', $items)->with('categories', $categories);
    }

    /**
     * Update the specified Stock in storage.
     *
     * @param int $id
     * @param UpdateStockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStockRequest $request)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found')->important();

            return redirect(route('stocks.index'));
        }

        $stock = $this->stockRepository->update($request->all(), $id);
        //Push record into stock history table
        // $stockHistory = new StockHistory();
        // $stockHistory->quantity = $stock->quantity;
        // $stockHistory->user_id = Auth::user()->id;
        // $stockHistory->category_name = $stock->category_name;
        // $stockHistory->item_name = $stock->item_name;
        // $stockHistory->date_added = $stock->date_added;
        // $stockHistory->save();


        Flash::success('Stock updated successfully.')->important();

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified Stock from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            Flash::error('Stock not found')->important();

            return redirect(route('stocks.index'));
        }

        $this->stockRepository->delete($id);

        Flash::success('Stock deleted successfully.')->important();

        return redirect(route('stocks.index'));
    }
}
