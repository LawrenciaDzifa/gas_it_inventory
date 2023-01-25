<?php

namespace App\Repositories;

use App\Models\StockHistory;
use App\Repositories\BaseRepository;

/**
 * Class StockHistoryRepository
 * @package App\Repositories
 * @version December 4, 2022, 11:16 am UTC
*/

class StockHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'item_name',
        'category_name',
        'quantity',
        'date_added'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return StockHistory::class;
    }
}
