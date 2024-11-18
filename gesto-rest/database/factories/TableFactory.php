<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Table;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, // Nombre aleatorio
            'capacity' => $this->faker->numberBetween(2, 6), // Capacidad entre 2 y 6
            'image' => $this->faker->imageUrl(100, 100), // URL de una imagen aleatoria
        ];
    }
}
