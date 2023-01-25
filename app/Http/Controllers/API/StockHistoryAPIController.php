<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockHistoryAPIRequest;
use App\Http\Requests\API\UpdateStockHistoryAPIRequest;
use App\Models\StockHistory;
use App\Repositories\StockHistoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StockHistoryController
 * @package App\Http\Controllers\API
 */

class StockHistoryAPIController extends AppBaseController
{
    /** @var  StockHistoryRepository */
    private $stockHistoryRepository;

    public function __construct(StockHistoryRepository $stockHistoryRepo)
    {
        $this->stockHistoryRepository = $stockHistoryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/stockHistories",
     *      summary="getStockHistoryList",
     *      tags={"StockHistory"},
     *      description="Get all StockHistories",
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
     *                  @OA\Items(ref="#/definitions/StockHistory")
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
        $stockHistories = $this->stockHistoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($stockHistories->toArray(), 'Stock Histories retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/stockHistories",
     *      summary="createStockHistory",
     *      tags={"StockHistory"},
     *      description="Create StockHistory",
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
     *                  ref="#/definitions/StockHistory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockHistoryAPIRequest $request)
    {
        $input = $request->all();

        $stockHistory = $this->stockHistoryRepository->create($input);

        return $this->sendResponse($stockHistory->toArray(), 'Stock History saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/stockHistories/{id}",
     *      summary="getStockHistoryItem",
     *      tags={"StockHistory"},
     *      description="Get StockHistory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of StockHistory",
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
     *                  ref="#/definitions/StockHistory"
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
        /** @var StockHistory $stockHistory */
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            return $this->sendError('Stock History not found');
        }

        return $this->sendResponse($stockHistory->toArray(), 'Stock History retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/stockHistories/{id}",
     *      summary="updateStockHistory",
     *      tags={"StockHistory"},
     *      description="Update StockHistory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of StockHistory",
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
     *                  ref="#/definitions/StockHistory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockHistoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var StockHistory $stockHistory */
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            return $this->sendError('Stock History not found');
        }

        $stockHistory = $this->stockHistoryRepository->update($input, $id);

        return $this->sendResponse($stockHistory->toArray(), 'StockHistory updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/stockHistories/{id}",
     *      summary="deleteStockHistory",
     *      tags={"StockHistory"},
     *      description="Delete StockHistory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of StockHistory",
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
        /** @var StockHistory $stockHistory */
        $stockHistory = $this->stockHistoryRepository->find($id);

        if (empty($stockHistory)) {
            return $this->sendError('Stock History not found');
        }

        $stockHistory->delete();

        return $this->sendSuccess('Stock History deleted successfully');
    }
}
