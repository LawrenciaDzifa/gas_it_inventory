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
use Laracasts\Flash\Flash as FlashFlash;

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
        $stock = Stock::where('item_name', $input['item_name'])->first();
        if ($stock->quantity < $request->qty_requested) {
            Flash::error('The quantity you are requesting is more that the quantity in stock')->important();
            return redirect(route('requisitions.index'));
        } else {

            $requisition = $this->requisitionRepository->create($input);

            Flash::success('Requisition saved successfully.')->important();

            return redirect(route('requisitions.index'));
        }
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
            Flash::error('Requisition not found')->important();
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
            Flash::error('Requisition not found')->important();

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
            Flash::error('Requisition not found')->important();

            return redirect(route('requisitions.index'));
        }

        $requisition = $this->requisitionRepository->update($request->all(), $id);

        Flash::success('Requisition updated successfully.');

        return redirect(route('requisitions.index'));
    }

    //Function to approve a specific requisition and update stock

    public function approve($id)
    {

        // Update the requisition's status of a specific request to "approved"
        $requisition = Requisition::find($id);
        $requisition->status = "approved";
        $requisition->save();

        // Retrieve the stock object using the ID
        $stock = Stock::where('item_name', $requisition->item_name)->first();



        // Update the stock quantity
        $stock->quantity = ($stock->quantity - $requisition->qty_requested);

        if (!$stock->save()) {
            return redirect()->back()->with('error', 'Error updating stock.');
        }

        // Redirect the user back with a success message
        return redirect()->back()->with('success', 'Requisition approved and stock updated successfully.');
    }
    // Function to decline a specific requisition

    public function decline($id)
    {
        // Retrieve the requisition object using the provided ID
        $requisition = Requisition::find($id);

        // Update the requisition's status to "declined"
        $requisition->status = 'declined';
        $requisition->save();
        // Redirect the user back to the requisition list page
        return redirect()->route('requisitions.index');

        // Redirect the user back with a denial message
        // return redirect()->back()->with('danger', 'Requisition has been declined. Please try again later');
    }

    // Function to search for a specific requisition

    public function search(Request $request)
    {
        $search = $request->get('search');
        $data = Requisition::where('column_name', 'like', '%' . $search . '%')->get();
        return view('requisition.index', ['data' => $data]);
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
            Flash::error('Requisition not found')->important();

            return redirect(route('requisitions.index'));
        }

        $this->requisitionRepository->delete($id);

        Flash::success('Requisition deleted successfully.')->important();

        return redirect(route('requisitions.index'));
    }
}
