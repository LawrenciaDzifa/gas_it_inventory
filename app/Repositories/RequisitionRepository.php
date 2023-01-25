<?php

namespace App\Repositories;

use App\Models\Requisition;
use App\Repositories\BaseRepository;

/**
 * Class RequisitionRepository
 * @package App\Repositories
 * @version December 12, 2022, 11:10 am UTC
*/

class RequisitionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user',
        'item_name',
        'qty_requested',
        'msg'
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
        return Requisition::class;
    }
}
