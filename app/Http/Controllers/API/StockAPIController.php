<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStockAPIRequest;
use App\Http\Requests\API\UpdateStockAPIRequest;
use App\Models\Stock;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class StockController
 * @package App\Http\Controllers\API
 */

class StockAPIController extends AppBaseController
{
    /** @var  StockRepository */
    private $stockRepository;

    public function __construct(StockRepository $stockRepo)
    {
        $this->stockRepository = $stockRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Get(
     *      path="/stocks",
     *      summary="getStockList",
     *      tags={"Stock"},
     *      description="Get all Stocks",
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
     *                  @OA\Items(ref="#/definitions/Stock")
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
        $stocks = $this->stockRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($stocks->toArray(), 'Stocks retrieved successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @OA\Post(
     *      path="/stocks",
     *      summary="createStock",
     *      tags={"Stock"},
     *      description="Create Stock",
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
     *                  ref="#/definitions/Stock"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStockAPIRequest $request)
    {
        $input = $request->all();

        $stock = $this->stockRepository->create($input);

        return $this->sendResponse($stock->toArray(), 'Stock saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Get(
     *      path="/stocks/{id}",
     *      summary="getStockItem",
     *      tags={"Stock"},
     *      description="Get Stock",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Stock",
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
     *                  ref="#/definitions/Stock"
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
        /** @var Stock $stock */
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            return $this->sendError('Stock not found');
        }

        return $this->sendResponse($stock->toArray(), 'Stock retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     *
     * @OA\Put(
     *      path="/stocks/{id}",
     *      summary="updateStock",
     *      tags={"Stock"},
     *      description="Update Stock",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Stock",
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
     *                  ref="#/definitions/Stock"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStockAPIRequest $request)
    {
        $input = $request->all();

        /** @var Stock $stock */
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            return $this->sendError('Stock not found');
        }

        $stock = $this->stockRepository->update($input, $id);

        return $this->sendResponse($stock->toArray(), 'Stock updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @OA\Delete(
     *      path="/stocks/{id}",
     *      summary="deleteStock",
     *      tags={"Stock"},
     *      description="Delete Stock",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Stock",
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
        /** @var Stock $stock */
        $stock = $this->stockRepository->find($id);

        if (empty($stock)) {
            return $this->sendError('Stock not found');
        }

        $stock->delete();

        return $this->sendSuccess('Stock deleted successfully');
    }
}
