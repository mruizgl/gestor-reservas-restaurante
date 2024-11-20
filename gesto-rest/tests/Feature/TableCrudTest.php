<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Space;
use App\Models\Table;
use App\Models\User;

/**
 * Testing de las mesas
 */
class TableCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Simular que somos admin
     */
    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);
    }

     /**
     * Test para verificar que las mesas puedan ser creadas correctamente.
     */
    public function test_it_can_create_tables()
    {
        // Crea un usuario administrador autenticado
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Crea un espacio necesario para asociar las mesas
        $space = Space::factory()->create();

        // Datos para crear mesas
        $data = [
            'space_id' => $space->id,
            'tables' => ['1-1', '1-2'], // Fila-Columna de las mesas
            'capacity' => [ // Capacidad específica para cada mesa
                '1-1' => 4,
                '1-2' => 6,
            ],
        ];

        // Realizar el POST a la ruta para almacenar mesas
        $response = $this->post(route('tables.store'), $data);

        // Verificar redirección al dashboard de administración
        $response->assertRedirect(route('admin.dashboard'));

        // Confirmar que el mensaje de éxito está en la sesión
        $response->assertSessionHas('success', 'Mesas añadidas correctamente.');

        // Confirmar que las mesas se guardaron en la base de datos
        foreach ($data['tables'] as $tablePosition) {
            [$row, $col] = explode('-', $tablePosition);

            $this->assertDatabaseHas('tables', [
                'space_id' => $space->id,
                'row' => $row,
                'column' => $col,
                'capacity' => $data['capacity'][$tablePosition],
            ]);
        }
    }

    /**
     * Test de read de mesas
     */
    public function test_it_can_read_tables()
    {
        $space = Space::factory()->create();
        $table = Table::factory()->create(['space_id' => $space->id]);

        $response = $this->get(route('reservations.create'));
        $response->assertStatus(200);
        $response->assertSee($table->row);
        $response->assertSee($table->column);
        $response->assertSee($table->capacity);
    }

   

  
}
