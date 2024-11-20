
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\YourModel; // Cambiar por el modelo correspondiente

class CrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a record.
     */
    public function test_create_record()
    {
        $response = $this->post('/your-crud-route', [
            'field1' => 'value1',
            'field2' => 'value2',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('your_table', [
            'field1' => 'value1',
        ]);
    }

    /**
     * Test reading a record.
     */
    public function test_read_record()
    {
        $model = YourModel::factory()->create();

        $response = $this->get('/your-crud-route/' . $model->id);
        $response->assertStatus(200);
        $response->assertJson($model->toArray());
    }

    /**
     * Test updating a record.
     */
    public function test_update_record()
    {
        $model = YourModel::factory()->create();

        $response = $this->put('/your-crud-route/' . $model->id, [
            'field1' => 'new_value',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('your_table', [
            'id' => $model->id,
            'field1' => 'new_value',
        ]);
    }

    /**
     * Test deleting a record.
     */
    public function test_delete_record()
    {
        $model = YourModel::factory()->create();

        $response = $this->delete('/your-crud-route/' . $model->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('your_table', [
            'id' => $model->id,
        ]);
    }
}
