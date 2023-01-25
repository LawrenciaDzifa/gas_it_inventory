<?php namespace Tests\Repositories;

use App\Models\StockHistory;
use App\Repositories\StockHistoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StockHistoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StockHistoryRepository
     */
    protected $stockHistoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->stockHistoryRepo = \App::make(StockHistoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_stock_history()
    {
        $stockHistory = StockHistory::factory()->make()->toArray();

        $createdStockHistory = $this->stockHistoryRepo->create($stockHistory);

        $createdStockHistory = $createdStockHistory->toArray();
        $this->assertArrayHasKey('id', $createdStockHistory);
        $this->assertNotNull($createdStockHistory['id'], 'Created StockHistory must have id specified');
        $this->assertNotNull(StockHistory::find($createdStockHistory['id']), 'StockHistory with given id must be in DB');
        $this->assertModelData($stockHistory, $createdStockHistory);
    }

    /**
     * @test read
     */
    public function test_read_stock_history()
    {
        $stockHistory = StockHistory::factory()->create();

        $dbStockHistory = $this->stockHistoryRepo->find($stockHistory->id);

        $dbStockHistory = $dbStockHistory->toArray();
        $this->assertModelData($stockHistory->toArray(), $dbStockHistory);
    }

    /**
     * @test update
     */
    public function test_update_stock_history()
    {
        $stockHistory = StockHistory::factory()->create();
        $fakeStockHistory = StockHistory::factory()->make()->toArray();

        $updatedStockHistory = $this->stockHistoryRepo->update($fakeStockHistory, $stockHistory->id);

        $this->assertModelData($fakeStockHistory, $updatedStockHistory->toArray());
        $dbStockHistory = $this->stockHistoryRepo->find($stockHistory->id);
        $this->assertModelData($fakeStockHistory, $dbStockHistory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_stock_history()
    {
        $stockHistory = StockHistory::factory()->create();

        $resp = $this->stockHistoryRepo->delete($stockHistory->id);

        $this->assertTrue($resp);
        $this->assertNull(StockHistory::find($stockHistory->id), 'StockHistory should not exist in DB');
    }
}
