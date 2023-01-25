<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Stock;

class StockApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_stock()
    {
        $stock = Stock::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/stocks', $stock
        );

        $this->assertApiResponse($stock);
    }

    /**
     * @test
     */
    public function test_read_stock()
    {
        $stock = Stock::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/stocks/'.$stock->id
        );

        $this->assertApiResponse($stock->toArray());
    }

    /**
     * @test
     */
    public function test_update_stock()
    {
        $stock = Stock::factory()->create();
        $editedStock = Stock::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/stocks/'.$stock->id,
            $editedStock
        );

        $this->assertApiResponse($editedStock);
    }

    /**
     * @test
     */
    public function test_delete_stock()
    {
        $stock = Stock::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/stocks/'.$stock->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/stocks/'.$stock->id
        );

        $this->response->assertStatus(404);
    }
}
