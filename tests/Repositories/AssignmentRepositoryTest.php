<?php namespace Tests\Repositories;

use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AssignmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AssignmentRepository
     */
    protected $assignmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->assignmentRepo = \App::make(AssignmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_assignment()
    {
        $assignment = Assignment::factory()->make()->toArray();

        $createdAssignment = $this->assignmentRepo->create($assignment);

        $createdAssignment = $createdAssignment->toArray();
        $this->assertArrayHasKey('id', $createdAssignment);
        $this->assertNotNull($createdAssignment['id'], 'Created Assignment must have id specified');
        $this->assertNotNull(Assignment::find($createdAssignment['id']), 'Assignment with given id must be in DB');
        $this->assertModelData($assignment, $createdAssignment);
    }

    /**
     * @test read
     */
    public function test_read_assignment()
    {
        $assignment = Assignment::factory()->create();

        $dbAssignment = $this->assignmentRepo->find($assignment->id);

        $dbAssignment = $dbAssignment->toArray();
        $this->assertModelData($assignment->toArray(), $dbAssignment);
    }

    /**
     * @test update
     */
    public function test_update_assignment()
    {
        $assignment = Assignment::factory()->create();
        $fakeAssignment = Assignment::factory()->make()->toArray();

        $updatedAssignment = $this->assignmentRepo->update($fakeAssignment, $assignment->id);

        $this->assertModelData($fakeAssignment, $updatedAssignment->toArray());
        $dbAssignment = $this->assignmentRepo->find($assignment->id);
        $this->assertModelData($fakeAssignment, $dbAssignment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_assignment()
    {
        $assignment = Assignment::factory()->create();

        $resp = $this->assignmentRepo->delete($assignment->id);

        $this->assertTrue($resp);
        $this->assertNull(Assignment::find($assignment->id), 'Assignment should not exist in DB');
    }
}
