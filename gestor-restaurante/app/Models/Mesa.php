<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'ubicacion', 
        'capacidad',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
