<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        static::created(function ($reservation) {
            event(new \App\Events\ModelChanged($reservation));
        });

        static::updated(function ($reservation) {
            event(new \App\Events\ModelChanged($reservation));
        });

        static::deleted(function ($reservation) {
            DB::connection('sqlite')
                ->table($reservation->getTable())
                ->where('id', $reservation->id)
                ->delete();
        });
    }

}