@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 animate-fade-in">

<!-- Mensagens de Feedback (Sucesso/Erro) -->

@if (session('success'))

<div class="mb-6 p-4 bg-destaque-meigo/10 border border-destaque-meigo text-destaque-meigo rounded-xl text-lg font-semibold flex items-center">
<i class="fas fa-check-circle mr-3"></i> {{ session('success') }}
</div>
@endif

<!-- Cabeçalho e Botão de Voltar -->

<div class="flex items-center mb-6">
<a href="{{ route('pets.index') }}" class="text-destaque-meigo hover:text-azul-bebe mr-4 transition duration-150">
<i class="fas fa-arrow-left text-2xl"></i>
</a>
<h1 class="text-4xl font-extrabold text-texto-escuro flex items-center">
Detalhes de {{ $pet->nome }} 🐾
</h1>
</div>

<!-- Cartão Principal de Informações do Pet (VISUAL CORRIGIDO) -->

<div class="bg-white p-6 sm:p-8 rounded-2xl card-shadow mb-8 border-t-8 border-destaque-meigo">
<h3 class="text-2xl font-bold text-texto-escuro mb-5">
Informações Básicas
<a href="{{ route('pets.edit', $pet->id) }}" class="ml-4 text-sm font-semibold text-azul-bebe hover:text-destaque-meigo transition duration-150 flex items-center">
<i class="fas fa-edit mr-2"></i> Editar Informações
</a>
</h3>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-lg">

<!-- Espécie -->
<div class="col-span-1">
    <p class="font-bold text-gray-500 mb-1">Espécie:</p>
    <p class="text-texto-escuro">{{ $pet->especie }}</p>
</div>

<!-- Idade (CORRIGIDA: Exibindo a idade inteira) -->
<div class="col-span-1">
    <p class="font-bold text-gray-500 mb-1">Idade:</p>
    <p class="text-texto-escuro">{{ $pet->idade }} anos</p>
</div>

<!-- Peso (Adicionado ao resumo) -->
<div class="col-span-1">
    <p class="font-bold text-gray-500 mb-1">Peso:</p>
    <p class="text-texto-escuro">{{ number_format($pet->peso, 1) }} kg</p>
</div>


</div>

</div>

<!-- SEÇÃO CARTEIRINHA DE AGENDAMENTOS (Vacinas e Consultas) -->

<div class="mt-10">
<h2 class="text-3xl font-extrabold text-texto-escuro mb-5 border-b pb-2 border-bege-suave">
📚 Carteirinha de Agendamentos
</h2>

<!-- Botões de Ação (Adicionar Vacina e Adicionar Consulta) -->

<div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
<!-- Botão Adicionar Vacina (Rosa Mauve) -->
<a href="{{ route('vacinas.create', $pet->id) }}"
class="flex-1 flex items-center justify-center py-3 px-4 bg-destaque-meigo text-white rounded-xl font-bold text-md shadow-md hover:bg-destaque-meigo/90 transition duration-300 transform hover:scale-[1.01]">
<i class="fas fa-syringe mr-2"></i> Adicionar Vacina
</a>

<!-- Botão Adicionar Consulta (Azul Bebê) -->
<a href="{{ route('consultas.create', $pet->id) }}"
   class="flex-1 flex items-center justify-center py-3 px-4 bg-azul-bebe text-white rounded-xl font-bold text-md shadow-md hover:bg-azul-bebe/90 transition duration-300 transform hover:scale-[1.01]">
    <i class="fas fa-notes-medical mr-2"></i> Adicionar Consulta
</a>


</div>

<!-- Histórico de Consultas -->

<div class="mb-10 bg-white p-6 rounded-xl card-shadow border-l-4 border-azul-bebe">
<h3 class="text-xl font-bold text-texto-escuro mb-4 flex items-center">
<i class="fas fa-clipboard-list mr-2 text-azul-bebe"></i> Histórico de Consultas
</h3>

@if ($pet->consultas->isEmpty())
    <p class="text-gray-500 italic">Nenhuma consulta registrada ainda.</p>
@else
    <div class="space-y-4">
        @foreach ($pet->consultas->sortByDesc('data_consulta') as $consulta)
            <div class="p-4 bg-fundo-pastel/50 rounded-lg border border-bege-suave hover:bg-fundo-pastel/70 transition duration-150">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold text-texto-escuro">
                            {{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y') }}
                            - {{ $consulta->motivo }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ Str::limit($consulta->observacoes, 150) }}
                        </p>
                    </div>
                    <form action="{{ route('consultas.destroy', [$pet->id, $consulta->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta consulta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm p-1 transition duration-150" title="Remover Consulta">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif


</div>

<!-- Histórico de Vacinação -->

<div class="mb-10 bg-white p-6 rounded-xl card-shadow border-l-4 border-destaque-meigo">
<h3 class="text-xl font-bold text-texto-escuro mb-4 flex items-center">
<i class="fas fa-syringe mr-2 text-destaque-meigo"></i> Histórico de Vacinação
</h3>

@if ($pet->vacinas->isEmpty())
    <p class="text-gray-500 italic">Nenhuma vacina registrada ainda.</p>
@else
    <div class="space-y-4">
        @foreach ($pet->vacinas->sortByDesc('data_aplicada') as $vacina)
            <div class="p-4 bg-fundo-pastel/50 rounded-lg border border-bege-suave hover:bg-fundo-pastel/70 transition duration-150">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold text-texto-escuro">
                            {{ \Carbon\Carbon::parse($vacina->data_aplicada)->format('d/m/Y') }}
                            - {{ $vacina->descricao }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1">
                            Próxima dose: {{ $vacina->proxima_dose ? \Carbon\Carbon::parse($vacina->proxima_dose)->format('d/m/Y') : 'Não agendada' }}
                        </p>
                    </div>
                    <form action="{{ route('vacinas.destroy', [$pet->id, $vacina->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta vacina?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm p-1 transition duration-150" title="Remover Vacina">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif


</div>

</div>

<style>
/* Estilos para o Card Shadow e animação */
.card-shadow {
box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
}
@keyframes fadeIn {
from { opacity: 0; transform: translateY(10px); }
to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
animation: fadeIn 0.5s ease-out;
}
</style>

@endsection
