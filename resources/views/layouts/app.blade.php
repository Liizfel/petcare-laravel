<?php
// Verifica se a rota atual é 'login' ou 'register' para ocultar a navegação principal.
$isAuthPage = request()->routeIs('login') || request()->routeIs('register');
?>

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PetCare | Agenda de Cuidados</title>

<!-- Tailwind CSS (Usando CDN para simplificar) -->

<script src="https://cdn.tailwindcss.com"></script>

<!-- Configuração da Paleta de Cores MEIGA E DELICADA -->

<script>
tailwind.config = {
theme: {
extend: {
colors: {
// PALETA DE CALMARIA MEIGA
'fundo-pastel': '#FBF8F5',      // Bege muito suave (Base)
'destaque-meigo': '#D8A7B1',    // Rosa/Mauve Suave (Ação Primária/Botões)
'azul-bebe': '#B3CDE0',         // Azul Bebê (Links/Consultas)
'verde-vacina': '#C8E6C9',      // Verde Menta (Vacinas)
'bege-suave': '#F7EDE2',       // Bege Quente (Bordas/Cards)
'texto-escuro': '#3D3D3D',      // Texto Escuro
},
fontFamily: {
sans: ['Inter', 'sans-serif'],
},
}
}
}
</script>

<!-- Ícones (Font Awesome) -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- CSS para Design Clean -->

<style>
/* Estilo para um visual mais clean */
.card-shadow { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
</style>

</head>
<body class="bg-fundo-pastel min-h-screen text-texto-escuro font-sans">

<div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">

@if (!$isAuthPage)

<!-- Cabeçalho / Navegação (VISÍVEL APENAS QUANDO LOGADO) -->

<header class="mb-8 p-4 bg-white rounded-xl card-shadow flex justify-between items-center sticky top-4 z-10">
<a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
<i class="fas fa-paw text-destaque-meigo text-3xl"></i>
<h1 class="text-2xl font-bold text-texto-escuro">PetCare</h1>
</a>

<!-- Menu de Navegação e Usuário (Simplificado) -->
<nav class="flex items-center space-x-4">

    <!-- Botão Primário "Adicionar Pet" -->
    <a href="{{ route('pets.create') }}" class="flex items-center px-4 py-2 bg-destaque-meigo text-white rounded-full font-semibold shadow-md hover:bg-destaque-meigo/90 transition duration-300 text-sm">
        <i class="fas fa-plus mr-2"></i> Adicionar Pet
    </a>

    <!-- Link Secundário "Meus Pets" -->
    <a href="{{ route('pets.index') }}" class="text-destaque-meigo hover:text-azul-bebe font-medium px-3 py-1 rounded-lg transition duration-150 ease-in-out hidden sm:inline">
        <i class="fas fa-list-ul mr-1"></i> Meus Pets
    </a>

    <!-- Botão de Sair/Logout (Direto no Header) -->
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="flex items-center space-x-2 text-texto-escuro/70 hover:text-red-500 transition duration-150 p-2 rounded-full">
        <span class="text-sm font-semibold hidden sm:inline">{{ Auth::user()->name ?? 'Usuário' }}</span>
        <i class="fas fa-sign-out-alt text-xl"></i>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>


</header>
@endif

<!-- Conteúdo Específico da Página -->

<main>
@yield('content')
</main>

<!-- Rodapé Simples -->

<footer class="mt-12 text-center text-sm text-texto-escuro/60 border-t pt-4">
&copy; {{ date('Y') }} PetCare - Desenvolvido com 🐾 e Laravel.
</footer>

</div>

<!-- Alpine.js (Necessário para alguns componentes futuros, mas não mais para o Logout) -->

<script src="https://www.google.com/search?q=https://cdn.jsdelivr.net/gh/alpinejs/alpine%40v3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>
