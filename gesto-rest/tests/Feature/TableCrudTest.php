
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Table; // Modelo relacionado

class TableCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creación de un nuevo registro en Table.
     */
    public function test_create_table()
    {
        $response = $this->post('/tables', [
            'field1' => 'value1', // Sustituir por los campos reales
            'field2' => 'value2',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tables', [
            'field1' => 'value1',
        ]);
    }

    /**
     * Test lectura de un registro de Table.
     */
    public function test_read_table()
    {
        $model = Table::factory()->create();

        $response = $this->get('/tables/' . $model->id);
        $response->assertStatus(200);
        $response->assertJson($model->toArray());
    }

    /**
     * Test actualización de un registro de Table.
     */
    public function test_update_table()
    {
        $model = Table::factory()->create();

        $response = $this->put('/tables/' . $model->id, [
            'field1' => 'updated_value',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tables', [
            'id' => $model->id,
            'field1' => 'updated_value',
        ]);
    }

    /**
     * Test eliminación de un registro de Table.
     */
    public function test_delete_table()
    {
        $model = Table::factory()->create();

        $response = $this->delete('/tables/' . $model->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tables', [
            'id' => $model->id,
        ]);
    }
}
