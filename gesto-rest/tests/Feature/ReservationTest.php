<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Space;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crea datos base para las pruebas
        $this->space = Space::factory()->create();
        $this->table = Table::factory()->create([
            'space_id' => $this->space->id,
        ]);
        $this->user = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    /** @test */
    public function it_can_create_a_reservation()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('reservations.store'), [
            'table_id' => $this->table->id,
            'customer_name' => 'John Doe',
            'customer_phone' => '1234567890',
            'num_people' => 4,
            'reservation_time' => Carbon::now()->addHours(3)->toDateTimeString(),
        ]);

        $response->assertRedirect(route('reservations.create'));
        $response->assertSessionHas('success', 'Reserva realizada con éxito!');
        $this->assertDatabaseHas('reservations', [
            'table_id' => $this->table->id,
            'customer_name' => 'John Doe',
        ]);
    }

    /** @test */
    public function it_validates_reservation_time_conflicts()
    {
        $this->actingAs($this->user);

        // Crea una reserva inicial
        Reservation::factory()->create([
            'table_id' => $this->table->id,
            'reservation_time' => Carbon::now()->addHours(3)->toDateTimeString(),
        ]);

        // Intenta crear una reserva en conflicto
        $response = $this->post(route('reservations.store'), [
            'table_id' => $this->table->id,
            'customer_name' => 'Jane Doe',
            'customer_phone' => '0987654321',
            'num_people' => 2,
            'reservation_time' => Carbon::now()->addHours(4)->toDateTimeString(), // En conflicto
        ]);

        $response->assertSessionHasErrors(['error' => 'La mesa ya está reservada en este horario.']);
        $this->assertDatabaseMissing('reservations', ['customer_name' => 'Jane Doe']);
    }

    /** @test */
    public function it_can_update_a_reservation()
    {
        $this->actingAs($this->user);

        $reservation = Reservation::factory()->create([
            'table_id' => $this->table->id,
            'customer_name' => 'John Doe',
        ]);

        $response = $this->put(route('reservations.update', $reservation->id), [
            'table_id' => $this->table->id,
            'customer_name' => 'Jane Doe',
            'customer_phone' => '0987654321',
            'num_people' => 6,
            'reservation_time' => Carbon::now()->addHours(5)->toDateTimeString(),
        ]);

        $response->assertRedirect(route('reservations.index'));
        $response->assertSessionHas('success', 'Reserva actualizada correctamente');
        $this->assertDatabaseHas('reservations', ['customer_name' => 'Jane Doe']);
    }

    /** @test */
    public function it_can_delete_a_reservation()
    {
        $this->actingAs($this->user);

        $reservation = Reservation::factory()->create([
            'table_id' => $this->table->id,
        ]);

        $response = $this->delete(route('reservations.destroy', $reservation->id));

        $response->assertRedirect(route('reservations.create'));
        $response->assertSessionHas('success', 'Reserva cancelada con éxito.');
        $this->assertDatabaseMissing('reservations', ['id' => $reservation->id]);
    }
}
