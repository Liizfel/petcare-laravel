<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Vacina;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Exibe o Dashboard principal com estatísticas e alertas.
     */
    public function index()
    {
        $userId = Auth::id();
        $pets = Pet::where('user_id', $userId)->get();

        $totalPets = $pets->count();

        // 1. Busca todas as vacinas do usuário que têm uma próxima dose definida
        $vacinasProximas = Vacina::whereHas('pet', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->whereNotNull('proxima_dose')
        ->with('pet') // Carrega o pet relacionado para exibir o nome no dashboard
        ->get();

        // 2. Filtra alertas
        $hoje = Carbon::today();
        $proximoMes = $hoje->copy()->addDays(30);

        $alertasAtrasados = collect();
        $alertasProximos = collect();

        foreach ($vacinasProximas as $vacina) {
            $proximaDose = Carbon::parse($vacina->proxima_dose);

            if ($proximaDose->isBefore($hoje)) {
                // Vacinas com data no passado (ATRASADAS)
                $alertasAtrasados->push($vacina);
            } elseif ($proximaDose->isBetween($hoje, $proximoMes, true)) {
                // Vacinas que vencem nos próximos 30 dias (PRÓXIMAS)
                $alertasProximos->push($vacina);
            }
        }

        // 3. Busca consultas futuras
        $consultasProximas = $pets->flatMap(function ($pet) {
            return $pet->consultas
                ->filter(function ($consulta) {
                    return Carbon::parse($consulta->data_consulta)->isFuture();
                })
                ->map(function ($consulta) use ($pet) {
                    $consulta->pet_name = $pet->nome; // Adiciona o nome do pet
                    return $consulta;
                });
        })->sortBy('data_consulta');

        $totalConsultasProximas = $consultasProximas->count();

        // Passa todos os dados para a view
        return view('dashboard', compact(
            'totalPets',
            'alertasAtrasados',
            'alertasProximos',
            'consultasProximas',
            'totalConsultasProximas'
        ));
    }
}
