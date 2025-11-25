@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
<h2 class="text-3xl font-extrabold text-texto-escuro">
🐾 Meus Pets
</h2>
<!-- Botão de 'Adicionar Pet' aparece apenas em mobile (o principal está no header) -->
<a href="{{ route('pets.create') }}" class="flex items-center px-4 py-2 bg-destaque-meigo text-white rounded-full font-semibold shadow-md hover:bg-destaque-meigo/90 transition duration-300 sm:hidden">
<i class="fas fa-plus mr-2"></i> Adicionar Pet
</a>
</div>

<!-- Grid de Pets -->

@if ($pets->isEmpty())

<div class="text-center py-16 bg-bege-suave rounded-xl shadow-inner border border-bege-suave/50">
    <i class="fas fa-exclamation-circle text-azul-bebe text-4xl mb-4"></i>
    <p class="text-lg font-medium text-texto-escuro">Você ainda não tem pets cadastrados.</p>
    <p class="text-texto-escuro/70 mt-2">Clique no botão "Adicionar Pet" no cabeçalho para começar a cuidar!</p>
</div>


@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach ($pets as $pet)
<!-- Cartão Fofo do Pet -->
<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 p-5 border-t-4 border-destaque-meigo">

            <!-- Ícone / Foto Placeholder -->
            <div class="flex justify-center mb-4">
                @if ($pet->foto)
                    <!-- Implementar lógica real de foto aqui -->
                    <img src="{{ $pet->foto }}" alt="{{ $pet->nome }}" class="w-20 h-20 rounded-full object-cover border-4 border-bege-suave shadow-inner">
                @else
                    <!-- Placeholder visual fofo -->
                    <div class="w-20 h-20 bg-azul-bebe/30 rounded-full flex items-center justify-center border-4 border-bege-suave shadow-inner">
                        <i class="fas fa-{{ $pet->especie === 'Gato' ? 'cat' : 'dog' }} text-azul-bebe text-4xl"></i>
                    </div>
                @endif
            </div>

            <h3 class="text-center text-xl font-bold text-texto-escuro mb-1">{{ $pet->nome }}</h3>
            <p class="text-center text-sm text-texto-escuro/70 mb-4">{{ $pet->especie }} &middot; {{ $pet->idade }} anos</p>

            <!-- Status Simplificado (Ajustado para cores meigas) -->
            <div class="flex justify-around items-center border-t border-b border-bege-suave py-3 mb-4">
                <div class="text-center">
                    <span class="text-xs font-semibold uppercase text-destaque-meigo bg-verde-vacina px-2 py-0.5 rounded-full">
                        Em Dia
                    </span>
                </div>
                <div class="text-center">
                    <i class="fas fa-weight-scale text-azul-bebe"></i>
                    <p class="text-sm font-medium mt-1">{{ number_format($pet->peso, 1) }} kg</p>
                </div>
            </div>

            <!-- Botão de Detalhes -->
            <a href="{{ route('pets.show', $pet->id) }}" class="block w-full text-center py-2 text-sm bg-bege-suave text-texto-escuro rounded-lg font-medium hover:bg-bege-suave/80 transition duration-150">
                Ver Detalhes e Agenda
            </a>
        </div>
    @endforeach
</div>


@endif

@endsection
