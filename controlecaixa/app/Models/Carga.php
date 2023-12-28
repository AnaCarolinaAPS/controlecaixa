<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_enviada',
        'data_recebida',
        'peso_guia',
        'tipo',
        'despachante',
        'embarcador',
    ];
}
