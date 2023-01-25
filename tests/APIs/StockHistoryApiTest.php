<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StockHistory;

class StockHistoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock_history()
    {
        $stockHistory = StockHistory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stock_histories', $stockHistory
        );

        $this->assertApiResponse($stockHistory);
    }

    /**
     * @test
     */
    public function test_read_stock_history()
    {
        $stockHistory = StockHistory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stock_histories/'.$stockHistory->id
        );

        $this->assertApiResponse($stockHistory->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock_history()
    {
        $stockHistory = StockHistory::factory()->create();
        $editedStockHistory = StockHistory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stock_histories/'.$stockHistory->id,
            $editedStockHistory
        );

        $this->assertApiResponse($editedStockHistory);
    }

    /**
     * @test
     */
    public function test_delete_stock_history()
    {
        $stockHistory = StockHistory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stock_histories/'.$stockHistory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stock_histories/'.$stockHistory->id
        );

        $this->response->assertStatus(404);
    }
}
