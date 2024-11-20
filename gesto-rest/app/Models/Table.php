<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Modelo de mesas
 * @author Melissa Ruiz y Noelia
 */
class Table extends Model
{
    use HasFactory;

    protected $fillable = ['space_id', 'row', 'column', 'capacity', 'ubicacion'];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    protected static function booted()
    {
        // Al crear una mesa, sincronizar con SQLite
        static::created(function ($table) {
            try {
                DB::connection('sqlite')->table($table->getTable())->insert($table->toArray());
            } catch (\Exception $e) {
                Log::error('Error syncing Table creation to SQLite: ' . $e->getMessage());
            }
        });

        // Al actualizar una mesa, sincronizar con SQLite
        static::updated(function ($table) {
            try {
                DB::connection('sqlite')
                    ->table($table->getTable())
                    ->where('id', $table->id)
                    ->update($table->toArray());
            } catch (\Exception $e) {
                Log::error('Error syncing Table update to SQLite: ' . $e->getMessage());
            }
        });

        // Al eliminar una mesa, sincronizar con SQLite
        static::deleted(function ($table) {
            try {
                DB::connection('sqlite')
                    ->table($table->getTable())
                    ->where('id', $table->id)
                    ->delete();
            } catch (\Exception $e) {
                Log::error('Error syncing Table deletion to SQLite: ' . $e->getMessage());
            }
        });
    }
}
