<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

/**
 * Testing del CRUD de Usuarios
 * @author Melissa Ruiz y Noelia
 */
class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de crear usuario
     */
    public function test_it_can_create_a_user()
    {
        // Crear un usuario administrador autenticado
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Datos del nuevo usuario
        $data = [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo.usuario@example.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ];

        // Realizar el POST para crear un usuario
        $response = $this->post(route('admin.storeUser'), $data);

        // Verificar redirección y mensaje de éxito
        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success', 'Usuario creado con éxito.');

        // Confirmar que el usuario fue creado en la base de datos
        $this->assertDatabaseHas('users', [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo.usuario@example.com',
        ]);
    }

    /**
     * Test de leer usuario
     */
    public function test_it_can_read_users()
    {
        // Crear un usuario administrador autenticado
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Crear usuarios
        $users = User::factory(3)->create();

        // Obtener la lista de usuarios
        $response = $this->get(route('admin.users.index'));

        // Verificar estado y contenido
        $response->assertStatus(200);
        foreach ($users as $user) {
            $response->assertSee($user->name);
            $response->assertSee($user->email);
        }
    }

    /**
     * Test de actualizar usuario
     */
    public function test_it_can_update_a_user()
    {
        // Crear un usuario administrador autenticado
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Crear un usuario a actualizar
        $user = User::factory()->create();

        // Nuevos datos del usuario
        $updatedData = [
            'name' => 'Usuario Actualizado',
            'email' => 'actualizado@example.com',
            'role' => 'user',
        ];

        // Realizar el PUT para actualizar el usuario
        $response = $this->put(route('admin.users.update', $user->id), $updatedData);

        // Verificar redirección y mensaje de éxito
        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success', 'Empleado actualizado correctamente.');

        // Confirmar que los datos fueron actualizados en la base de datos
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Usuario Actualizado',
            'email' => 'actualizado@example.com',
            'role' => 'user',
        ]);
    }

    /**
     * Test de eliminar usuarios
     */
    public function test_it_can_delete_a_user()
    {
        // Crear un usuario administrador autenticado
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Crear un usuario a eliminar
        $user = User::factory()->create();

        // Realizar el DELETE para eliminar el usuario
        $response = $this->delete(route('admin.users.destroy', $user->id));

        // Verificar redirección y mensaje de éxito
        $response->assertRedirect(route('admin.users.index'));
        $response->assertSessionHas('success', 'Empleado eliminado correctamente.');

        // Confirmar que el usuario fue eliminado de la base de datos
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
