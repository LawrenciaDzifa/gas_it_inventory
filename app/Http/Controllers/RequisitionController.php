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
            // send an sms to the user acknowledging the requisition and an sms to admin of incoming requisition
            // $admin= Auth::user()->role->admin;
            // $admin_phone = $admin->phone;
            $user = Auth::user()->find($requisition->user);
            $phone = $user->phone;
            $item = Item::where('id', $requisition->item_name)->first();
            $item_name = $item->name;
            $pending_sms = new SMSController();
            $pending_sms = $pending_sms->sendSMS('Your requisition for ' . $requisition->qty_requested  . ' ' .   $item_name . ' is currently pending. You will be notified of the next status of your requisition soon. Thank you.', $phone);
            // $admin_sms = new SMSController();
            // $admin_sms = $admin_sms->sendSMS('You have a new requisition from ' . $user->name . ' for ' . $requisition->item_name . '. Please attend to it.', $admin_phone);
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
        // check if the requisition has already been approved
        $requisition = Requisition::find($id);
        if ($requisition->status == 'pending') {
            //set status to approved
            $requisition->status = 'approved';
            $requisition->save();
            // Retrieve the stock object using the ID
            $stock = Stock::where('item_name', $requisition->item_name)->first();
            // Update the stock quantity
            $stock->quantity = ($stock->quantity - $requisition->qty_requested);
            $stock->save();
            // send an sms to the user that the requisition has been approved
            $user = Auth::user()->find($requisition->user);
            $phone = $user->phone;
            $item = Item::where('id', $requisition->item_name)->first();
            $item_name = $item->name;
            $approval_sms = new SMSController();
            $approval_sms->sendSMS('Your requisition for ' . $requisition->qty_requested  . ' ' .   $item_name . ' has been approved. Thank you.', $phone);
            Flash::success('Requisition approved successfully.')->important();
            return redirect()->route('requisitions.index');
        }
        if ($requisition->status == 'declined') {
            Flash::error('Your request for has already been declined and cannot be approved .')->important();
            return redirect(route('requisitions.index'));
        }
        if ($requisition->status == 'approved') {

            Flash::error('This request has already been approved.')->important();
            return redirect()->route('requisitions.index');
        }
    }
    // Function to decline a specific requisition

    public function decline($id)
    {
        // Retrieve the requisition object using the provided ID
        $requisition = Requisition::find($id);

        // Update the requisition's status to "declined"
        if ($requisition->status == 'pending') {
            $requisition->status = 'declined';
            $requisition->save();
            // send decline sms to the user
            $user = Auth::user()->find($requisition->user);
            $phone = $user->phone;
            $item = Item::where('id', $requisition->item_name)->first();
            $item_name = $item->name;
            $decline_sms = new SMSController();
            $decline_sms->sendSMS('Your requisition for ' .  $requisition->qty_requested  . ' ' .   $item_name .  ' has been declined. Please contact your unit head and try again later. Thank you', $phone);
            Flash::success('Requisition declined successfully.')->important();
            return redirect()->route('requisitions.index');
        }
        if ($requisition->status == 'declined') {
            Flash::error('This request has already been declined .')->important();
            return redirect()->route('requisitions.index');
        };
        if ($requisition->status == 'approved') {
            Flash::error('This request has already been approved and cannot be declined .')->important();
            return redirect()->route('requisitions.index');
        }
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
