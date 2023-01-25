<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRestockAPIRequest;
use App\Http\Requests\API\UpdateRestockAPIRequest;
use App\Models\Restock;
use App\Repositories\RestockRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RestockController
 * @package App\Http\Controllers\API
 */

class RestockAPIController extends AppBaseController
{
    /** @var  RestockRepository */
    private $restockRepository;

    public function __construct(RestockRepository $restockRepo)
    {
        $this->restockRepository = $restockRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/restocks",
     *      summary="getRestockList",
     *      tags={"Restock"},
     *      description="Get all Restocks",
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
     *                  @OA\Items(ref="#/definitions/Restock")
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
        $restocks = $this->restockRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($restocks->toArray(), 'Restocks retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/restocks",
     *      summary="createRestock",
     *      tags={"Restock"},
     *      description="Create Restock",
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
     *                  ref="#/definitions/Restock"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRestockAPIRequest $request)
    {
        $input = $request->all();

        $restock = $this->restockRepository->create($input);

        return $this->sendResponse($restock->toArray(), 'Restock saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/restocks/{id}",
     *      summary="getRestockItem",
     *      tags={"Restock"},
     *      description="Get Restock",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Restock",
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
     *                  ref="#/definitions/Restock"
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
        /** @var Restock $restock */
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            return $this->sendError('Restock not found');
        }

        return $this->sendResponse($restock->toArray(), 'Restock retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/restocks/{id}",
     *      summary="updateRestock",
     *      tags={"Restock"},
     *      description="Update Restock",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Restock",
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
     *                  ref="#/definitions/Restock"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRestockAPIRequest $request)
    {
        $input = $request->all();

        /** @var Restock $restock */
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            return $this->sendError('Restock not found');
        }

        $restock = $this->restockRepository->update($input, $id);

        return $this->sendResponse($restock->toArray(), 'Restock updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/restocks/{id}",
     *      summary="deleteRestock",
     *      tags={"Restock"},
     *      description="Delete Restock",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Restock",
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
        /** @var Restock $restock */
        $restock = $this->restockRepository->find($id);

        if (empty($restock)) {
            return $this->sendError('Restock not found');
        }

        $restock->delete();

        return $this->sendSuccess('Restock deleted successfully');
    }
}
