<?php namespace Tests\Repositories;

use App\Models\Restock;
use App\Repositories\RestockRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RestockRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RestockRepository
     */
    protected $restockRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->restockRepo = \App::make(RestockRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_restock()
    {
        $restock = Restock::factory()->make()->toArray();

        $createdRestock = $this->restockRepo->create($restock);

        $createdRestock = $createdRestock->toArray();
        $this->assertArrayHasKey('id', $createdRestock);
        $this->assertNotNull($createdRestock['id'], 'Created Restock must have id specified');
        $this->assertNotNull(Restock::find($createdRestock['id']), 'Restock with given id must be in DB');
        $this->assertModelData($restock, $createdRestock);
    }

    /**
     * @test read
     */
    public function test_read_restock()
    {
        $restock = Restock::factory()->create();

        $dbRestock = $this->restockRepo->find($restock->id);

        $dbRestock = $dbRestock->toArray();
        $this->assertModelData($restock->toArray(), $dbRestock);
    }

    /**
     * @test update
     */
    public function test_update_restock()
    {
        $restock = Restock::factory()->create();
        $fakeRestock = Restock::factory()->make()->toArray();

        $updatedRestock = $this->restockRepo->update($fakeRestock, $restock->id);

        $this->assertModelData($fakeRestock, $updatedRestock->toArray());
        $dbRestock = $this->restockRepo->find($restock->id);
        $this->assertModelData($fakeRestock, $dbRestock->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_restock()
    {
        $restock = Restock::factory()->create();

        $resp = $this->restockRepo->delete($restock->id);

        $this->assertTrue($resp);
        $this->assertNull(Restock::find($restock->id), 'Restock should not exist in DB');
    }
}
