<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequisitionAPIRequest;
use App\Http\Requests\API\UpdateRequisitionAPIRequest;
use App\Models\Requisition;
use App\Repositories\RequisitionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RequisitionController
 * @package App\Http\Controllers\API
 */

class RequisitionAPIController extends AppBaseController
{
    /** @var  RequisitionRepository */
    private $requisitionRepository;

    public function __construct(RequisitionRepository $requisitionRepo)
    {
        $this->requisitionRepository = $requisitionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/requisitions",
     *      summary="getRequisitionList",
     *      tags={"Requisition"},
     *      description="Get all Requisitions",
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
     *                  @OA\Items(ref="#/definitions/Requisition")
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
        $requisitions = $this->requisitionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($requisitions->toArray(), 'Requisitions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/requisitions",
     *      summary="createRequisition",
     *      tags={"Requisition"},
     *      description="Create Requisition",
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
     *                  ref="#/definitions/Requisition"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRequisitionAPIRequest $request)
    {
        $input = $request->all();

        $requisition = $this->requisitionRepository->create($input);

        return $this->sendResponse($requisition->toArray(), 'Requisition saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/requisitions/{id}",
     *      summary="getRequisitionItem",
     *      tags={"Requisition"},
     *      description="Get Requisition",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Requisition",
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
     *                  ref="#/definitions/Requisition"
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
        /** @var Requisition $requisition */
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            return $this->sendError('Requisition not found');
        }

        return $this->sendResponse($requisition->toArray(), 'Requisition retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/requisitions/{id}",
     *      summary="updateRequisition",
     *      tags={"Requisition"},
     *      description="Update Requisition",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Requisition",
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
     *                  ref="#/definitions/Requisition"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRequisitionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Requisition $requisition */
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            return $this->sendError('Requisition not found');
        }

        $requisition = $this->requisitionRepository->update($input, $id);

        return $this->sendResponse($requisition->toArray(), 'Requisition updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/requisitions/{id}",
     *      summary="deleteRequisition",
     *      tags={"Requisition"},
     *      description="Delete Requisition",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Requisition",
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
        /** @var Requisition $requisition */
        $requisition = $this->requisitionRepository->find($id);

        if (empty($requisition)) {
            return $this->sendError('Requisition not found');
        }

        $requisition->delete();

        return $this->sendSuccess('Requisition deleted successfully');
    }
}
