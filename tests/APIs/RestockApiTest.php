<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Restock;

class RestockApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_restock()
    {
        $restock = Restock::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/restocks', $restock
        );

        $this->assertApiResponse($restock);
    }

    /**
     * @test
     */
    public function test_read_restock()
    {
        $restock = Restock::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/restocks/'.$restock->id
        );

        $this->assertApiResponse($restock->toArray());
    }

    /**
     * @test
     */
    public function test_update_restock()
    {
        $restock = Restock::factory()->create();
        $editedRestock = Restock::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/restocks/'.$restock->id,
            $editedRestock
        );

        $this->assertApiResponse($editedRestock);
    }

    /**
     * @test
     */
    public function test_delete_restock()
    {
        $restock = Restock::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/restocks/'.$restock->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/restocks/'.$restock->id
        );

        $this->response->assertStatus(404);
    }
}
