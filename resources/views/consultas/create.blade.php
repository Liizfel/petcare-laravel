@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto animate-fade-in">
<div class="flex items-center mb-6">
<a href="{{ route('pets.show', $pet->id) }}" class="text-destaque-meigo hover:text-azul-bebe mr-4 transition duration-150">
<i class="fas fa-arrow-left text-2xl"></i>
</a>
<h2 class="text-3xl font-extrabold text-texto-escuro">
🩺 Agendar Consulta para {{ $pet->nome }}
</h2>
</div>

<!-- Cartão do Formulário, elegante e com borda Azul Bebê (Cor de Consulta) -->
<div class="bg-white p-8 rounded-2xl card-shadow border-t-8 border-azul-bebe">

    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
            <p class="font-bold mb-1">Oh não! Algo deu errado:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- O action usa a rota aninhada 'consultas.store' -->
    <form method="POST" action="{{ route('consultas.store', $pet->id) }}">
        @csrf

        <!-- Campo Data da Consulta -->
        <div class="mb-5">
            <label for="data_consulta" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                <i class="fas fa-calendar-alt mr-2 text-azul-bebe"></i> Data da Consulta
            </label>
            <input type="date" name="data_consulta" id="data_consulta" value="{{ old('data_consulta') }}"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-azul-bebe focus:border-azul-bebe transition duration-150 bg-fundo-pastel/50">
        </div>

        <!-- Campo Motivo -->
        <div class="mb-5">
            <label for="motivo" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                <i class="fas fa-search mr-2 text-azul-bebe"></i> Motivo da Consulta
            </label>
            <input type="text" name="motivo" id="motivo" value="{{ old('motivo') }}"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-azul-bebe focus:border-azul-bebe transition duration-150 bg-fundo-pastel/50"
                   placeholder="Ex: Check-up anual, Tosse e febre, etc.">
        </div>

        <!-- Campo Observações -->
        <div class="mb-6">
            <label for="observacoes" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                <i class="fas fa-notes-medical mr-2 text-azul-bebe"></i> Observações (Diagnóstico, Tratamento, etc.)
            </label>
            <textarea name="observacoes" id="observacoes" rows="4"
                  class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-azul-bebe focus:border-azul-bebe transition duration-150 bg-fundo-pastel/50"
                  placeholder="Detalhes importantes da consulta">{{ old('observacoes') }}</textarea>
        </div>

        <!-- Botão de Submissão usa a cor principal (Rosa Mauve) -->
        <button type="submit" class="w-full flex items-center justify-center py-3 bg-destaque-meigo text-white rounded-xl font-bold text-lg shadow-md hover:bg-destaque-meigo/90 transition duration-300 transform hover:scale-[1.01]">
            <i class="fas fa-calendar-check mr-2"></i> Agendar e Registrar
        </button>
    </form>
</div>


</div>

<style>
/* Adicionando uma animação suave para a entrada do formulário */
@keyframes fadeIn {
from { opacity: 0; transform: translateY(10px); }
to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
animation: fadeIn 0.5s ease-out;
}
</style>

@endsection
