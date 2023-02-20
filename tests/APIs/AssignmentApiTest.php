<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Assignment;

class AssignmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_assignment()
    {
        $assignment = Assignment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/assignments', $assignment
        );

        $this->assertApiResponse($assignment);
    }

    /**
     * @test
     */
    public function test_read_assignment()
    {
        $assignment = Assignment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/assignments/'.$assignment->id
        );

        $this->assertApiResponse($assignment->toArray());
    }

    /**
     * @test
     */
    public function test_update_assignment()
    {
        $assignment = Assignment::factory()->create();
        $editedAssignment = Assignment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/assignments/'.$assignment->id,
            $editedAssignment
        );

        $this->assertApiResponse($editedAssignment);
    }

    /**
     * @test
     */
    public function test_delete_assignment()
    {
        $assignment = Assignment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/assignments/'.$assignment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/assignments/'.$assignment->id
        );

        $this->response->assertStatus(404);
    }
}
