
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Space; // Modelo relacionado

class SpaceCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creación de un nuevo registro en Space.
     */
    public function test_create_space()
    {
        $response = $this->post('/spaces', [
            'field1' => 'value1', // Sustituir por los campos reales
            'field2' => 'value2',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('spaces', [
            'field1' => 'value1',
        ]);
    }

    /**
     * Test lectura de un registro de Space.
     */
    public function test_read_space()
    {
        $model = Space::factory()->create();

        $response = $this->get('/spaces/' . $model->id);
        $response->assertStatus(200);
        $response->assertJson($model->toArray());
    }

    /**
     * Test actualización de un registro de Space.
     */
    public function test_update_space()
    {
        $model = Space::factory()->create();

        $response = $this->put('/spaces/' . $model->id, [
            'field1' => 'updated_value',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('spaces', [
            'id' => $model->id,
            'field1' => 'updated_value',
        ]);
    }

    /**
     * Test eliminación de un registro de Space.
     */
    public function test_delete_space()
    {
        $model = Space::factory()->create();

        $response = $this->delete('/spaces/' . $model->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('spaces', [
            'id' => $model->id,
        ]);
    }
}
