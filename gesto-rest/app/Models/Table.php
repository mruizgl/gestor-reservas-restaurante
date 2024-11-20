<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
