@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto animate-fade-in">
<div class="flex items-center mb-6">
<a href="{{ route('pets.index') }}" class="text-destaque-meigo hover:text-azul-bebe mr-4 transition duration-150">
<i class="fas fa-arrow-left text-2xl"></i>
</a>
<h2 class="text-3xl font-extrabold text-texto-escuro">
💕 Detalhes do Novo Amigo
</h2>
</div>

<!-- Cartão do Formulário, mais elegante e com borda meiga -->
<div class="bg-white p-8 rounded-2xl card-shadow border-t-8 border-destaque-meigo">

    <!-- Mensagens de Erro (Estilo discreto) -->
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

    <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Campo Nome -->
        <div class="mb-5">
            <label for="nome" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                <i class="fas fa-tag mr-2 text-destaque-meigo"></i> Nome do Pet
            </label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50"
                   placeholder="Ex: Max, Luna">
        </div>

        <!-- Campo Espécie -->
        <div class="mb-5">
            <label for="especie" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                <i class="fas fa-paw mr-2 text-destaque-meigo"></i> Espécie
            </label>
            <select name="especie" id="especie"
                    class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50">
                <option value="">Selecione a Espécie</option>
                <option value="Cachorro" {{ old('especie') == 'Cachorro' ? 'selected' : '' }}>Cachorro 🐕</option>
                <option value="Gato" {{ old('especie') == 'Gato' ? 'selected' : '' }}>Gato 🐈</option>
                <option value="Outro" {{ old('especie') == 'Outro' ? 'selected' : '' }}>Outro 🐹</option>
            </select>
        </div>

        <!-- Campos Idade e Peso (Flexível) -->
        <div class="flex space-x-4 mb-6">
            <div class="w-1/2">
                <label for="idade" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                     <i class="fas fa-birthday-cake mr-2 text-destaque-meigo"></i> Idade (anos)
                </label>
                <input type="number" name="idade" id="idade" value="{{ old('idade') }}" min="0" max="30"
                       class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50"
                       placeholder="Ex: 5">
            </div>
            <div class="w-1/2">
                <label for="peso" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                    <i class="fas fa-weight-scale mr-2 text-destaque-meigo"></i> Peso (kg)
                </label>
                <input type="number" step="0.1" name="peso" id="peso" value="{{ old('peso') }}" min="0.1" max="200"
                       class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50"
                       placeholder="Ex: 12.5">
            </div>
        </div>

        <!-- Botão de Submissão -->
        <button type="submit" class="w-full flex items-center justify-center py-3 bg-destaque-meigo text-white rounded-xl font-bold text-lg shadow-md hover:bg-destaque-meigo/90 transition duration-300 transform hover:scale-[1.01]">
            <i class="fas fa-heart mr-2"></i> Salvar Pet
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
