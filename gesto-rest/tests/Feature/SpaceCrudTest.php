<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Space;
use App\Models\User;

/**
 * Testing del crud de espacios
 */
class SpaceCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Seteamos y simulamos ser admin para poder realizar el crud ya que solo lo puede hacer el admin
     */
    protected function setUp(): void
    {
        parent::setUp();

       
        $this->actingAs(User::factory()->create(['role' => 'admin']));
    }

    public function test_it_can_create_a_space()
    {
        $data = [
            'name' => 'Espacio de Prueba',
            'rows' => 5,
            'columns' => 5,
            'description' => 'Descripción del espacio de prueba.',
        ];

        $response = $this->post(route('spaces.store'), $data);

        $response->assertRedirect(route('spaces.index'));
        $response->assertSessionHas('success', 'Espacio creado correctamente.');

        $this->assertDatabaseHas('spaces', $data);
    }

    public function test_it_can_read_spaces()
    {
        $space = Space::factory()->create();

        $response = $this->get(route('spaces.index'));

        $response->assertStatus(200);
        $response->assertSee($space->name);
    }

    public function test_it_can_update_a_space()
    {
        $space = Space::factory()->create();

        $updatedData = [
            'name' => 'Espacio Actualizado',
            'rows' => 6,
            'columns' => 6,
            'description' => 'Descripción actualizada.',
        ];

        $response = $this->put(route('spaces.update', $space->id), $updatedData);

        $response->assertRedirect(route('spaces.index'));
        $response->assertSessionHas('success', 'Espacio actualizado correctamente.');

        $this->assertDatabaseHas('spaces', $updatedData);
    }

    public function test_it_can_delete_a_space()
    {
        $space = Space::factory()->create();

        $response = $this->delete(route('spaces.destroy', $space->id));

        $response->assertRedirect(route('spaces.index'));
        $response->assertSessionHas('success', 'Espacio eliminado correctamente.');

        $this->assertDatabaseMissing('spaces', ['id' => $space->id]);
    }
}
