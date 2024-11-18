<?php

use Tests\TestCase;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Desactivar el middleware de autenticación para todas las pruebas
        $this->withoutMiddleware(\App\Http\Middleware\Authenticate::class);
    }

    public function test_can_create_reservation()
    {
        // Crea una mesa de prueba
        $table = Table::factory()->create([
            'capacity' => 4,
            'image' => 'path/to/image.png',
        ]);

        // Crea una reserva válida
        $response = $this->post(route('reservations.store'), [
            'table_id' => $table->id,
            'customer_name' => 'John Doe',
            'customer_phone' => '1234567890',
            'num_people' => 4,
            'reservation_time' => Carbon::now()->addDay()->format('Y-m-d H:i:s'), // Reserva en 1 día
        ]);

        // Verifica que la reserva fue creada y redirigida correctamente
        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseHas('reservations', [
            'table_id' => $table->id,
            'customer_name' => 'John Doe',
        ]);
    }

    public function test_reservation_conflict()
    {
        $table = Table::factory()->create([
            'capacity' => 4,
            'image' => 'path/to/image.png',
        ]);

        // Reserva una mesa en un horario específico
        Reservation::create([
            'table_id' => $table->id,
            'customer_name' => 'Alice',
            'customer_phone' => '9876543210',
            'num_people' => 4,
            'reservation_time' => Carbon::now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        // Intenta crear una segunda reserva en el mismo horario
        $response = $this->post(route('reservations.store'), [
            'table_id' => $table->id,
            'customer_name' => 'Bob',
            'customer_phone' => '1231231230',
            'num_people' => 4,
            'reservation_time' => Carbon::now()->addDay()->format('Y-m-d H:i:s'),
        ]);

        // Verifica que el sistema devuelva el error
        $response->assertSessionHasErrors('error');
    }
}
