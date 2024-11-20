<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Space>
 */
class SpaceFactory extends Factory
{
    protected $model = Space::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'rows' => $this->faker->numberBetween(1, 10),
            'columns' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence(),
        ];
    }
}
