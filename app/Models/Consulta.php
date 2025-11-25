<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consulta extends Model
{
    use HasFactory;

    // Campos permitidos para atribuição em massa
    protected $fillable = [
        'pet_id',
        'data_consulta',
        'motivo',
        'observacoes',
    ];

    /**
     * Um registro de consulta pertence a um único Pet.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
