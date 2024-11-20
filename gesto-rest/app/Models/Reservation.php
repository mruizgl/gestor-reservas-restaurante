<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Modelo de reserva
 * @author Melissa Ruiz y Noelia
 */
class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id', 
        'customer_name', 
        'customer_phone', 
        'num_people', 
        'reservation_time'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    protected static function booted()
    {
        // Al crear una reserva, sincronizar con SQLite
        static::created(function ($reservation) {
            try {
                DB::connection('sqlite')->table($reservation->getTable())->insert($reservation->toArray());
            } catch (\Exception $e) {
                Log::error('Error syncing Reservation creation to SQLite: ' . $e->getMessage());
            }
        });

        // Al actualizar una reserva, sincronizar con SQLite
        static::updated(function ($reservation) {
            try {
                DB::connection('sqlite')
                    ->table($reservation->getTable())
                    ->where('id', $reservation->id)
                    ->update($reservation->toArray());
            } catch (\Exception $e) {
                Log::error('Error syncing Reservation update to SQLite: ' . $e->getMessage());
            }
        });

        // Al eliminar una reserva, sincronizar con SQLite
        static::deleted(function ($reservation) {
            try {
                DB::connection('sqlite')
                    ->table($reservation->getTable())
                    ->where('id', $reservation->id)
                    ->delete();
            } catch (\Exception $e) {
                Log::error('Error syncing Reservation deletion to SQLite: ' . $e->getMessage());
            }
        });
    }
}
