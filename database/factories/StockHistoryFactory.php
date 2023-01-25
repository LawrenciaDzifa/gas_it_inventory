<?php

namespace Database\Factories;

use App\Models\StockHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'item_name' => $this->faker->word,
        'category_name' => $this->faker->word,
        'quantity' => $this->faker->randomDigitNotNull,
        'date_added' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
