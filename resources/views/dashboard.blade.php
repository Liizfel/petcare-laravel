@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-extrabold text-texto-escuro mb-8 flex items-center">
<i class="fas fa-paw mr-3 text-destaque-meigo"></i> Dashboard de Saúde
</h2>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 gap-y-12 mb-10">

<div class="lg:col-span-1 bg-white p-5 rounded-xl shadow-lg border-t-4 border-destaque-meigo">
<h3 class="text-xl font-bold text-texto-escuro mb-4 flex items-center">
<i class="fas fa-calendar-alt mr-2 text-azul-bebe"></i> Agenda Rápida
</h3>

@php
    // Funções auxiliares para formatar datas e buscar eventos
    $formatDate = fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d');

    // Compilação de todos os eventos futuros em um array indexado pela data
    $eventosPorDia = [];

    // Mapeamento de Consultas
    foreach ($consultasProximas as $consulta) {
        $dateKey = $formatDate($consulta->data_consulta);
        if (!isset($eventosPorDia[$dateKey])) $eventosPorDia[$dateKey] = [];
        $eventosPorDia[$dateKey]['consulta'] = $consulta;
    }

    // Mapeamento de Vacinas
    foreach ($alertasProximos as $vacina) {
        $dateKey = $formatDate($vacina->proxima_dose);
        if (!isset($eventosPorDia[$dateKey])) $eventosPorDia[$dateKey] = [];
        // Se já houver consulta, não sobrescreve, apenas adiciona a vacina
        $eventosPorDia[$dateKey]['vacina'] = $vacina;
    }

    // Geração dos próximos 42 dias (6 semanas para preencher o calendário)
    $hoje = \Carbon\Carbon::today();
    $dias = [];

    // Determina o primeiro dia a ser exibido no calendário (o domingo da semana atual)
    $primeiroDiaExibido = $hoje->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);

    for ($i = 0; $i < 42; $i++) {
        $dias[] = $primeiroDiaExibido->copy()->addDays($i);
    }
@endphp

<div class="grid grid-cols-7 text-center text-sm font-semibold mb-2">
    @foreach (['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'] as $diaNome)
        <span class="text-texto-escuro/70">{{ $diaNome }}</span>
    @endforeach
</div>

<div class="grid grid-cols-7 gap-1">
    @foreach ($dias as $dia)
        @php
            $dateKey = $formatDate($dia);
            $eventos = $eventosPorDia[$dateKey] ?? null;
            $isConsulta = isset($eventos['consulta']);
            $isVacina = isset($eventos['vacina']);

            $bgClass = '';
            $tooltip = '';

            // Lógica de Cores
            if ($isConsulta && $isVacina) {
                // Combinação de cores para o dia com os 2 eventos
                $bgClass = 'bg-gradient-to-br from-azul-bebe to-verde-vacina text-texto-escuro';
                $tooltip = 'Consulta & Vacina';
            } elseif ($isConsulta) {
                $bgClass = 'bg-azul-bebe text-white';
                $tooltip = 'Consulta';
            } elseif ($isVacina) {
                $bgClass = 'bg-verde-vacina text-texto-escuro';
                $tooltip = 'Vacina';
            }
        @endphp
        <div class="aspect-square flex items-center justify-center p-0.5 rounded-md text-xs font-medium relative
                    {{ $bgClass ?: 'bg-bege-suave text-texto-escuro/80 hover:bg-bege-suave/70' }}
                    {{ $dia->isToday() ? 'border-2 border-destaque-meigo font-bold' : '' }}"
             title="{{ $dia->isToday() ? 'Hoje' : '' }}{{ $tooltip ? ' - Evento: ' . $tooltip : '' }}"
             >
            {{ $dia->day }}
        </div>
    @endforeach
</div>


</div>

<div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
<div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-destaque-meigo transition duration-300 hover:shadow-2xl hover:scale-[1.01]">
<div class="flex items-center justify-between">
<i class="fas fa-users text-4xl text-destaque-meigo/70"></i>
<span class="text-4xl font-bold text-texto-escuro">{{ $totalPets }}</span>
</div>
<p class="mt-2 text-sm text-texto-escuro/80 font-semibold">Total de Pets Registrados</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-verde-vacina transition duration-300 hover:shadow-2xl hover:scale-[1.01]">
    <div class="flex items-center justify-between">
        <i class="fas fa-calendar-alt text-4xl text-verde-vacina/90"></i>
        <span class="text-4xl font-bold text-texto-escuro">{{ $alertasProximos->count() }}</span>
    </div>
    <p class="mt-2 text-sm text-texto-escuro/80 font-semibold">Vacinas Próximas (30 dias)</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-azul-bebe transition duration-300 hover:shadow-2xl hover:scale-[1.01]">
    <div class="flex items-center justify-between">
        <i class="fas fa-stethoscope text-4xl text-azul-bebe/70"></i>
        <span class="text-4xl font-bold text-texto-escuro">{{ $totalConsultasProximas }}</span>
    </div>
    <p class="mt-2 text-sm text-texto-escuro/80 font-semibold">Consultas Agendadas</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-lg border-b-4 border-bege-suave transition duration-300 hover:shadow-2xl hover:scale-[1.01]">
    <div class="flex items-center justify-between">
        <i class="fas fa-heartbeat text-4xl text-bege-suave/90"></i>
        <span class="text-4xl font-bold text-texto-escuro">100%</span>
    </div>
    <p class="mt-2 text-sm text-texto-escuro/80 font-semibold">Saúde em Dia</p>
</div>


</div>

</div>

<hr class="my-10 border-bege-suave/50">

<h3 class="text-2xl font-bold text-texto-escuro mb-4 flex items-center">
<i class="fas fa-bell mr-2 text-red-500"></i> Alertas de Vacinação
</h3>

@if ($alertasAtrasados->isNotEmpty())

    <div class="space-y-4 mb-10">
        @foreach ($alertasAtrasados as $alerta)
            {{-- Adicionado efeito hover suave no item da lista --}}
            <div class="bg-red-50 p-4 rounded-xl shadow-md border-l-4 border-red-500 flex justify-between items-center transition duration-200 hover:shadow-lg hover:bg-red-100">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-4 text-2xl"></i> {{-- Ícone maior --}}
                    <div>
                        <p class="text-lg font-semibold text-texto-escuro">Vacina {{ $alerta->descricao }} Atrasada ({{ $alerta->pet->nome }})</p>
                        <p class="text-sm text-texto-escuro/70">Vencimento era em: {{ \Carbon\Carbon::parse($alerta->proxima_dose)->format('d/m/Y') }}</p>
                    </div>
                </div>
                <a href="{{ route('pets.show', $alerta->pet->id) }}" class="text-red-500 hover:text-red-600 font-medium text-sm">Ação Urgente <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        @endforeach
    </div>

@else
    <div class="text-center py-6 mb-10 bg-verde-vacina/10 rounded-xl border border-verde-vacina/30">
        {{-- CORREÇÃO DE CONTRASTE APLICADA: text-verde-700 --}}
        <p class="text-lg font-medium text-verde-700 flex items-center justify-center">
            <i class="fas fa-check-circle mr-2"></i>
            Nenhuma vacina pendente ou atrasada. Todos os pets estão com a imunização em dia!
        </p>
    </div>
@endif

<h3 class="text-2xl font-bold text-texto-escuro mb-4 flex items-center">
<i class="fas fa-calendar-day mr-2 text-azul-bebe"></i> Próximos Eventos Detalhados
</h3>

@if ($alertasProximos->isEmpty() && $consultasProximas->isEmpty())
<div class="text-center py-12 bg-bege-suave rounded-xl shadow-inner border border-bege-suave/50">
<p class="text-lg font-medium text-texto-escuro/80">Nenhum evento futuro registrado para os próximos 30 dias.</p>
</div>
@else

<div class="space-y-4">

@foreach ($alertasProximos as $alerta)
    {{-- Adicionado efeito hover suave no item da lista --}}
    <div class="bg-white p-4 rounded-xl shadow-md border-l-4 border-verde-vacina flex justify-between items-center transition duration-200 hover:shadow-lg hover:bg-bege-suave/50">
        <div class="flex items-center">
            <i class="fas fa-syringe text-verde-vacina/90 mr-4 text-2xl"></i> {{-- Ícone maior --}}
            <div>
                <p class="text-lg font-semibold text-texto-escuro">Vacina {{ $alerta->descricao }} ({{ $alerta->pet->nome }})</p>
                <p class="text-sm text-texto-escuro/70">Vencimento em: {{ \Carbon\Carbon::parse($alerta->proxima_dose)->format('d/m/Y') }}</p>
            </div>
        </div>
        <a href="{{ route('pets.show', $alerta->pet->id) }}" class="text-verde-vacina hover:text-verde-vacina/80 font-medium text-sm">Detalhes <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
@endforeach

@foreach ($consultasProximas as $consulta)
    {{-- Adicionado efeito hover suave no item da lista --}}
    <div class="bg-white p-4 rounded-xl shadow-md border-l-4 border-azul-bebe flex justify-between items-center transition duration-200 hover:shadow-lg hover:bg-bege-suave/50">
        <div class="flex items-center">
            <i class="fas fa-stethoscope text-azul-bebe/90 mr-4 text-2xl"></i> {{-- Ícone maior --}}
            <div>
                <p class="text-lg font-semibold text-texto-escuro">Consulta de {{ $consulta->pet_name }}</p>
                <p class="text-sm text-texto-escuro/70">Motivo: {{ $consulta->motivo }} &middot; Data: {{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y') }}</p>
            </div>
        </div>
        <a href="{{ route('pets.show', $consulta->pet_id) }}" class="text-azul-bebe hover:text-azul-bebe/80 font-medium text-sm">Detalhes <i class="fas fa-arrow-right ml-1"></i></a>
    </div>
@endforeach


</div>

@endif

@endsection
