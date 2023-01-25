<?php

namespace App\Repositories;

use App\Models\Restock;
use App\Repositories\BaseRepository;

/**
 * Class RestockRepository
 * @package App\Repositories
 * @version January 16, 2023, 10:03 am UTC
*/

class RestockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_name',
        'restock_qty'
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
        return Restock::class;
    }
}
