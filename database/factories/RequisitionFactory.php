<?php

namespace Database\Factories;

use App\Models\Requisition;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequisitionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Requisition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user' => $this->faker->word,
        'item_name' => $this->faker->word,
        'qty_requested' => $this->faker->randomDigitNotNull,
        'msg' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
