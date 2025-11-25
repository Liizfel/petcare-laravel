@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto animate-fade-in">
<div class="flex items-center mb-6">
<a href="{{ route('pets.show', $pet->id) }}" class="text-destaque-meigo hover:text-azul-bebe mr-4 transition duration-150">
<i class="fas fa-arrow-left text-2xl"></i>
</a>
<h2 class="text-3xl font-extrabold text-texto-escuro">
💉 Agendar Vacina para {{ $pet->nome }}
</h2>
</div>

<!-- Cartão do Formulário, usando as cores meigas -->
<div class="bg-white p-8 rounded-2xl card-shadow border-t-8 border-verde-vacina">

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

    <!-- O action usa a rota aninhada 'vacinas.store' -->
    <form method="POST" action="{{ route('vacinas.store', $pet->id) }}">
        @csrf

        <!-- Campo Descrição -->
        <div class="mb-5">
            <label for="descricao" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                <i class="fas fa-syringe mr-2 text-verde-vacina"></i> Nome da Vacina
            </label>
            <input type="text" name="descricao" id="descricao" value="{{ old('descricao') }}"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-verde-vacina focus:border-verde-vacina transition duration-150 bg-fundo-pastel/50"
                   placeholder="Ex: Vacina Polivalente V10 ou Antirrábica">
        </div>

        <!-- Campos de Data (Aplicada e Próxima Dose) -->
        <div class="flex space-x-4 mb-6">
            <div class="w-1/2">
                <label for="data_aplicada" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                    <i class="fas fa-calendar-check mr-2 text-destaque-meigo"></i> Data de Aplicação
                </label>
                <input type="date" name="data_aplicada" id="data_aplicada" value="{{ old('data_aplicada') }}"
                       class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50">
            </div>
            <div class="w-1/2">
                <label for="proxima_dose" class="block text-sm font-medium text-texto-escuro mb-1 flex items-center">
                    <i class="fas fa-calendar-plus mr-2 text-destaque-meigo"></i> Próxima Dose (Opcional)
                </label>
                <input type="date" name="proxima_dose" id="proxima_dose" value="{{ old('proxima_dose') }}"
                       class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50">
            </div>
        </div>

        <!-- Botão de Submissão usa a cor principal (Rosa Mauve) -->
        <button type="submit" class="w-full flex items-center justify-center py-3 bg-destaque-meigo text-white rounded-xl font-bold text-lg shadow-md hover:bg-destaque-meigo/90 transition duration-300 transform hover:scale-[1.01]">
            <i class="fas fa-save mr-2"></i> Registrar Vacina
        </button>
    </form>
</div>


</div>

@endsection
