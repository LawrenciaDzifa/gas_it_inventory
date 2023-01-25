<?php

namespace App\Http\Controllers;

use App\DataTables\RequisitionDataTable;
use App\Http\Requests\CreateRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Repositories\RequisitionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\User;
use App\Models\Item;
use App\Models\Requisition;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends AppBaseController
{
    /** @var RequisitionRepository $requisitionRepository*/
    private $requisitionRepository;

    public function __construct(RequisitionRepository $requisitionRepo)
    {
        $this->requisitionRepository = $requisitionRepo;
    }

    /**
     * Display a listing of the Requisition.
     *
     * @param RequisitionDataTable $requisitionDataTable
     *
     * @return Response
     */
    public function index(RequisitionDataTable $requisitionDataTable)
    {
        return $requisitionDataTable->render('requisitions.index');
    }

    /**
     * Show the form for creating a new Requisition.
     *
     * @return Response
     */
    public function create()
    {
        $items = Item::pluck('name', 'id');
        $user = User::pluck('name', 'id');

        return view('requisitions.create')->with('items', $items)->with('user', $user);
    }

    /**
     * Store a newly created Requisition in storage.
     *
     * @param CreateRequisitionRequest $request
     *
     * @return Response
     */
    public function store(CreateRequisitionRequest $request)
    {
        $input = $request->all();


        $requisition = $this->requisitionRepository->create($input);

        Flash::success('Requisition saved successfully.');

        return redirect(route('requisitions.index'));
    }

    /**
     * Display the specified Requisition.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            Flash::error('Requisition not found');

            return redirect(route('requisitions.index'));
        }

        return view('requisitions.show')->with('requisition', $requisition);
    }

    /**
     * Show the form for editing the specified Requisition.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            Flash::error('Requisition not found');

            return redirect(route('requisitions.index'));
        }

        return view('requisitions.edit')->with('requisition', $requisition);
    }

    /**
     * Update the specified Requisition in storage.
     *
     * @param int $id
     * @param UpdateRequisitionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRequisitionRequest $request)
    {
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            Flash::error('Requisition not found');

            return redirect(route('requisitions.index'));
        }

        $requisition = $this->requisitionRepository->update($request->all(), $id);

        Flash::success('Requisition updated successfully.');

        return redirect(route('requisitions.index'));
    }

    //Function to approve requisition and update stock

    public function approve( $id)
    {


        // Validate the request data
        // $request->validate([
        //     'id' => 'required|exists:requisitions,id',
        //     'new_quantity' => 'required|numeric|min:1',
        // ]);
        // Update the requisition's status to "approved"
        $requisition = Requisition::find($id);
        $requisition->status = "approved";
        $requisition->save();

        // Retrieve the current stock for the item being requested
        $stock = Stock::where('id',  $id)->first();

        // Update the stock quantity
        $stock->quantity = ($stock->quantity - $requisition->qty_requested);
        $stock->save();


        // Redirect the user back with a success message
        return redirect()->back()->with('success', 'Requisition approved and stock updated successfully.');
    }


    // public function approve($id)
    // {
    //     // code to approve the record with the specified ID goes here

    // }

    public function decline($id)
    {
        // Retrieve the requisition object using the provided ID
        $requisition = Requisition::find($id);

        // Update the requisition's status to "declined"
        $requisition->status = 'declined';
        $requisition->save();

        // Retrieve the current stock for the item being requisitioned
        // $stock = Stock::where('item_name', $requisition->item_name)->first();

        // // Update the stock quantity with old quantity
        // $stock->quantity = ($stock->quantity);
        // $stock->save();


        // Redirect the user back to the requisition list page
        return redirect()->route('requisitions.index');

        // Redirect the user back with a denial message
        // return redirect()->back()->with('danger', 'Requisition has been declined. Please try again later');
    }


    /**
     * Remove the specified Requisition from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            Flash::error('Requisition not found');

            return redirect(route('requisitions.index'));
        }

        $this->requisitionRepository->delete($id);

        Flash::success('Requisition deleted successfully.');

        return redirect(route('requisitions.index'));
    }
}
