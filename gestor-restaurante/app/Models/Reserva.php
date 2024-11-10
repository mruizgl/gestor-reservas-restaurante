<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;


    protected $fillable = [
        'mesa_id',
        'user_id',
        'nombre_cliente',  
        'telefono_cliente', 
        'num_personas', 
        'fecha_hora',
    ];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
