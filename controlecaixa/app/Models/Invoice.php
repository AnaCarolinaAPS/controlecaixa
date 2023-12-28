<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'carga_id',
        'cliente_id',
        'peso_real',
        'peso_cobrado',
        'valor_cobrado',
    ];

    // Relacionamento com Client
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relacionamento com Client
    public function carga()
    {
        return $this->belongsTo(Carga::class);
    }
}
