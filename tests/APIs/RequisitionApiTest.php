<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Requisition;

class RequisitionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_requisition()
    {
        $requisition = Requisition::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/requisitions', $requisition
        );

        $this->assertApiResponse($requisition);
    }

    /**
     * @test
     */
    public function test_read_requisition()
    {
        $requisition = Requisition::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/requisitions/'.$requisition->id
        );

        $this->assertApiResponse($requisition->toArray());
    }

    /**
     * @test
     */
    public function test_update_requisition()
    {
        $requisition = Requisition::factory()->create();
        $editedRequisition = Requisition::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/requisitions/'.$requisition->id,
            $editedRequisition
        );

        $this->assertApiResponse($editedRequisition);
    }

    /**
     * @test
     */
    public function test_delete_requisition()
    {
        $requisition = Requisition::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/requisitions/'.$requisition->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/requisitions/'.$requisition->id
        );

        $this->response->assertStatus(404);
    }
}
