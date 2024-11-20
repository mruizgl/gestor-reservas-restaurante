
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Reservation; 

class ReservationCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creación de un nuevo registro en Reservation.
     */
    public function test_create_reservation()
    {
        $response = $this->post('/reservations', [
            'field1' => 'value1', // Sustituir por los campos reales
            'field2' => 'value2',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reservations', [
            'field1' => 'value1',
        ]);
    }

    /**
     * Test lectura de un registro de Reservation.
     */
    public function test_read_reservation()
    {
        $model = Reservation::factory()->create();

        $response = $this->get('/reservations/' . $model->id);
        $response->assertStatus(200);
        $response->assertJson($model->toArray());
    }

    /**
     * Test actualización de un registro de Reservation.
     */
    public function test_update_reservation()
    {
        $model = Reservation::factory()->create();

        $response = $this->put('/reservations/' . $model->id, [
            'field1' => 'updated_value',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('reservations', [
            'id' => $model->id,
            'field1' => 'updated_value',
        ]);
    }

    /**
     * Test eliminación de un registro de Reservation.
     */
    public function test_delete_reservation()
    {
        $model = Reservation::factory()->create();

        $response = $this->delete('/reservations/' . $model->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('reservations', [
            'id' => $model->id,
        ]);
    }
}
