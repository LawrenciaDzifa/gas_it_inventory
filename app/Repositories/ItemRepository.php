<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\BaseRepository;

/**
 * Class ItemRepository
 * @package App\Repositories
 * @version December 4, 2022, 9:37 am UTC
*/

class ItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category'
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
        return Item::class;
    }
}
