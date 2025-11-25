<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\VacinaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::middleware('auth')->group(function () {

    // Rota principal (Dashboard)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas de recurso para o CRUD de Pets
    Route::resource('pets', PetController::class);

    // Rotas aninhadas para Cuidados (Vacinas e Consultas)
    // O prefixo 'pets/{pet}' garante que todas as rotas neste grupo exigem um Pet ID
    Route::prefix('pets/{pet}')->group(function () {

        // --- ROTAS DE VACINAS ---
        Route::get('/vacinas/create', [VacinaController::class, 'create'])->name('vacinas.create');
        Route::post('/vacinas', [VacinaController::class, 'store'])->name('vacinas.store');
        Route::delete('/vacinas/{vacina}', [VacinaController::class, 'destroy'])->name('vacinas.destroy');

        // --- ROTAS DE CONSULTAS ---
        Route::get('/consultas/create', [ConsultaController::class, 'create'])->name('consultas.create');
        Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
        Route::delete('/consultas/{consulta}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');
    });
});

// A rota de redirecionamento padrão do laravel/ui
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
