<?php

namespace App\Http\Controllers;

use App\DataTables\AssignmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Repositories\AssignmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Item;
use Response;

class AssignmentController extends AppBaseController
{
    /** @var AssignmentRepository $assignmentRepository*/
    private $assignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepo)
    {
        $this->assignmentRepository = $assignmentRepo;
    }

    /**
     * Display a listing of the Assignment.
     *
     * @param AssignmentDataTable $assignmentDataTable
     *
     * @return Response
     */
    public function index(AssignmentDataTable $assignmentDataTable)
    {
        return $assignmentDataTable->render('assignments.index');
    }

    /**
     * Show the form for creating a new Assignment.
     *
     * @return Response
     */
    public function create()
    {
        $items = Item::pluck('name', 'id');
        // $users= User::pluck('name', 'id');
        return view('assignments.create')->with('items', $items);
    }

    /**
     * Store a newly created Assignment in storage.
     *
     * @param CreateAssignmentRequest $request
     *
     * @return Response
     */
    public function store(CreateAssignmentRequest $request)
    {
        $input = $request->all();

        $assignment = $this->assignmentRepository->create($input);

        Flash::success('Assignment saved successfully.');

        return redirect(route('assignments.index'));
    }

    /**
     * Display the specified Assignment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }

        return view('assignments.show')->with('assignment', $assignment);
    }

    /**
     * Show the form for editing the specified Assignment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assignment = $this->assignmentRepository->find($id);
        $items = Item::pluck('name', 'id');



        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }

        return view('assignments.edit')->with('assignment', $assignment)->with('items', $items);
    }

    /**
     * Update the specified Assignment in storage.
     *
     * @param int $id
     * @param UpdateAssignmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssignmentRequest $request)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }

        $assignment = $this->assignmentRepository->update($request->all(), $id);

        Flash::success('Assignment updated successfully.');

        return redirect(route('assignments.index'));
    }

    /**
     * Remove the specified Assignment from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Assignment not found');

            return redirect(route('assignments.index'));
        }

        $this->assignmentRepository->delete($id);

        Flash::success('Assignment deleted successfully.');

        return redirect(route('assignments.index'));
    }
}
