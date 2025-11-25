<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Modelos relacionados
use App\Models\User;
use App\Models\Vacina;
use App\Models\Consulta;


class Pet extends Model
{
    use HasFactory;

    // Campos permitidos para atribuição em massa (Mass Assignment)
    protected $fillable = [
        'user_id',
        'nome',
        'especie',
        'idade',
        'peso',
        'foto',
    ];

    // Relacionamento com o Usuário (Dono)
    /**
     * Um pet pertence a um usuário (dono).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com as Vacinas
    /**
     * Um pet possui muitos registros de vacinas.
     */
    public function vacinas(): HasMany
    {
        return $this->hasMany(Vacina::class);
    }

    // Relacionamento com as Consultas
    /**
     * Um pet possui muitos registros de consultas.
     */
    public function consultas(): HasMany
    {
        return $this->hasMany(Consulta::class);
    }
}
