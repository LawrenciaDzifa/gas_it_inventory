<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Repositories\BaseRepository;

/**
 * Class AssignmentRepository
 * @package App\Repositories
 * @version February 20, 2023, 8:33 pm UTC
*/

class AssignmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_name',
        'serial_number',
        'qty_assigned',
        'assigned_to'
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
        return Assignment::class;
    }
}
