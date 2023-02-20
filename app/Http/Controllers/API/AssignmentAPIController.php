<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAssignmentAPIRequest;
use App\Http\Requests\API\UpdateAssignmentAPIRequest;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AssignmentController
 * @package App\Http\Controllers\API
 */

class AssignmentAPIController extends AppBaseController
{
    /** @var  AssignmentRepository */
    private $assignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepo)
    {
        $this->assignmentRepository = $assignmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/assignments",
     *      summary="getAssignmentList",
     *      tags={"Assignment"},
     *      description="Get all Assignments",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/definitions/Assignment")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $assignments = $this->assignmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($assignments->toArray(), 'Assignments retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/assignments",
     *      summary="createAssignment",
     *      tags={"Assignment"},
     *      description="Create Assignment",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Assignment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAssignmentAPIRequest $request)
    {
        $input = $request->all();

        $assignment = $this->assignmentRepository->create($input);

        return $this->sendResponse($assignment->toArray(), 'Assignment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/assignments/{id}",
     *      summary="getAssignmentItem",
     *      tags={"Assignment"},
     *      description="Get Assignment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Assignment",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Assignment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Assignment $assignment */
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            return $this->sendError('Assignment not found');
        }

        return $this->sendResponse($assignment->toArray(), 'Assignment retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/assignments/{id}",
     *      summary="updateAssignment",
     *      tags={"Assignment"},
     *      description="Update Assignment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Assignment",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                required={""},
     *                @OA\Property(
     *                    property="name",
     *                    description="desc",
     *                    type="string"
     *                )
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/definitions/Assignment"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAssignmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Assignment $assignment */
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            return $this->sendError('Assignment not found');
        }

        $assignment = $this->assignmentRepository->update($input, $id);

        return $this->sendResponse($assignment->toArray(), 'Assignment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/assignments/{id}",
     *      summary="deleteAssignment",
     *      tags={"Assignment"},
     *      description="Delete Assignment",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Assignment",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Assignment $assignment */
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            return $this->sendError('Assignment not found');
        }

        $assignment->delete();

        return $this->sendSuccess('Assignment deleted successfully');
    }
}
