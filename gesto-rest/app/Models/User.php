<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Modelo de usuarios
 * @author Melissa Ruiz y Noelia
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

 /**
     * Eventos del modelo para sincronización con SQLite.
     */
    protected static function booted()
    {
        // Al crear un usuario, sincronizar con SQLite
        static::created(function ($user) {
            try {
                DB::connection('sqlite')->table($user->getTable())->insert($user->toArray());
            } catch (\Exception $e) {
                Log::error('Error syncing User creation to SQLite: ' . $e->getMessage());
            }
        });

        // Al actualizar un usuario, sincronizar con SQLite
        static::updated(function ($user) {
            try {
                DB::connection('sqlite')
                    ->table($user->getTable())
                    ->where('id', $user->id)
                    ->update($user->toArray());
            } catch (\Exception $e) {
                Log::error('Error syncing User update to SQLite: ' . $e->getMessage());
            }
        });

        // Al eliminar un usuario, sincronizar con SQLite
        static::deleted(function ($user) {
            try {
                DB::connection('sqlite')
                    ->table($user->getTable())
                    ->where('id', $user->id)
                    ->delete();
            } catch (\Exception $e) {
                Log::error('Error syncing User deletion to SQLite: ' . $e->getMessage());
            }
        });
    }

}
