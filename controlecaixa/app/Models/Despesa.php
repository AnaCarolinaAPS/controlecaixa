<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'valor',
        'data',
        'categoria_id',
        'subcategoria_id',
    ];

    // Relacionamento com Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relacionamento com Subcategoria
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
}
