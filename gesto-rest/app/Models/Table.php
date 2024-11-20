<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['space_id', 'row', 'column', 'capacity', 'ubicacion'];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
