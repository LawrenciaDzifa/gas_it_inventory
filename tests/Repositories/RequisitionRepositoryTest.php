<?php namespace Tests\Repositories;

use App\Models\Requisition;
use App\Repositories\RequisitionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RequisitionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequisitionRepository
     */
    protected $requisitionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->requisitionRepo = \App::make(RequisitionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_requisition()
    {
        $requisition = Requisition::factory()->make()->toArray();

        $createdRequisition = $this->requisitionRepo->create($requisition);

        $createdRequisition = $createdRequisition->toArray();
        $this->assertArrayHasKey('id', $createdRequisition);
        $this->assertNotNull($createdRequisition['id'], 'Created Requisition must have id specified');
        $this->assertNotNull(Requisition::find($createdRequisition['id']), 'Requisition with given id must be in DB');
        $this->assertModelData($requisition, $createdRequisition);
    }

    /**
     * @test read
     */
    public function test_read_requisition()
    {
        $requisition = Requisition::factory()->create();

        $dbRequisition = $this->requisitionRepo->find($requisition->id);

        $dbRequisition = $dbRequisition->toArray();
        $this->assertModelData($requisition->toArray(), $dbRequisition);
    }

    /**
     * @test update
     */
    public function test_update_requisition()
    {
        $requisition = Requisition::factory()->create();
        $fakeRequisition = Requisition::factory()->make()->toArray();

        $updatedRequisition = $this->requisitionRepo->update($fakeRequisition, $requisition->id);

        $this->assertModelData($fakeRequisition, $updatedRequisition->toArray());
        $dbRequisition = $this->requisitionRepo->find($requisition->id);
        $this->assertModelData($fakeRequisition, $dbRequisition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_requisition()
    {
        $requisition = Requisition::factory()->create();

        $resp = $this->requisitionRepo->delete($requisition->id);

        $this->assertTrue($resp);
        $this->assertNull(Requisition::find($requisition->id), 'Requisition should not exist in DB');
    }
}
