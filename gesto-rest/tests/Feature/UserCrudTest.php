
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; // Modelo relacionado

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creación de un nuevo registro en User.
     */
    public function test_create_user()
    {
        $response = $this->post('/users', [
            'field1' => 'value1', // Sustituir por los campos reales
            'field2' => 'value2',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'field1' => 'value1',
        ]);
    }

    /**
     * Test lectura de un registro de User.
     */
    public function test_read_user()
    {
        $model = User::factory()->create();

        $response = $this->get('/users/' . $model->id);
        $response->assertStatus(200);
        $response->assertJson($model->toArray());
    }

    /**
     * Test actualización de un registro de User.
     */
    public function test_update_user()
    {
        $model = User::factory()->create();

        $response = $this->put('/users/' . $model->id, [
            'field1' => 'updated_value',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $model->id,
            'field1' => 'updated_value',
        ]);
    }

    /**
     * Test eliminación de un registro de User.
     */
    public function test_delete_user()
    {
        $model = User::factory()->create();

        $response = $this->delete('/users/' . $model->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', [
            'id' => $model->id,
        ]);
    }
}
