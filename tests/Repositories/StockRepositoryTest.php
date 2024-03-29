<?php namespace Tests\Repositories;

use App\Models\Stock;
use App\Repositories\StockRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockRepository
     */
    protected $stockRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockRepo = \App::make(StockRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock()
    {
        $stock = Stock::factory()->make()->toArray();

        $createdStock = $this->stockRepo->create($stock);

        $createdStock = $createdStock->toArray();
        $this->assertArrayHasKey('id', $createdStock);
        $this->assertNotNull($createdStock['id'], 'Created Stock must have id specified');
        $this->assertNotNull(Stock::find($createdStock['id']), 'Stock with given id must be in DB');
        $this->assertModelData($stock, $createdStock);
    }

    /**
     * @test read
     */
    public function test_read_stock()
    {
        $stock = Stock::factory()->create();

        $dbStock = $this->stockRepo->find($stock->id);

        $dbStock = $dbStock->toArray();
        $this->assertModelData($stock->toArray(), $dbStock);
    }

    /**
     * @test update
     */
    public function test_update_stock()
    {
        $stock = Stock::factory()->create();
        $fakeStock = Stock::factory()->make()->toArray();

        $updatedStock = $this->stockRepo->update($fakeStock, $stock->id);

        $this->assertModelData($fakeStock, $updatedStock->toArray());
        $dbStock = $this->stockRepo->find($stock->id);
        $this->assertModelData($fakeStock, $dbStock->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock()
    {
        $stock = Stock::factory()->create();

        $resp = $this->stockRepo->delete($stock->id);

        $this->assertTrue($resp);
        $this->assertNull(Stock::find($stock->id), 'Stock should not exist in DB');
    }
}
