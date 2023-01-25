<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\BaseRepository;

/**
 * Class StockRepository
 * @package App\Repositories
 * @version December 4, 2022, 10:46 am UTC
*/

class StockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Stock::class;
    }
}
