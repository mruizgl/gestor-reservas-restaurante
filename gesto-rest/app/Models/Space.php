<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Modelo de espacios
 * @author Melissa Ruiz y Noelia
 */
class Space extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'rows', 'columns', 'description'];

    public function tables()
    {
        return $this->hasMany(Table::class);
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
