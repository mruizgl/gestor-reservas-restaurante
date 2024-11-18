<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Table; 
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'table_id' => Table::factory(), 
            'customer_name' => $this->faker->name,
            'customer_phone' => $this->faker->phoneNumber,
            'num_people' => $this->faker->numberBetween(1, 10),
            'reservation_time' => $this->faker->dateTimeBetween('now', '+1 week'),
        ];
    }
}
