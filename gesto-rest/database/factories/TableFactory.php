<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Table;
use App\Models\Space;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition()
    {
        return [
            'space_id' => Space::factory(), 
            'row' => $this->faker->numberBetween(1, 5),
            'column' => $this->faker->numberBetween(1, 5),
            'capacity' => $this->faker->numberBetween(2, 10),
            'ubicacion' => $this->faker->word(),
        ];
    }
}
