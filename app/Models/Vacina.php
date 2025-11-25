<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacina extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'descricao',
        'data_aplicada',
        'proxima_dose',
    ];

    /**
     * Um registro de vacina pertence a um único Pet.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
