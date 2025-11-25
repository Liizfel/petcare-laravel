@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-12 sm:mt-20">
<div class="text-center mb-8">
<!-- Ícone agora usa a cor principal meiga: destaque-meigo -->
<i class="fas fa-paw text-destaque-meigo text-5xl mb-3"></i>
<h1 class="text-3xl font-extrabold text-texto-escuro">Criar Conta PetCare</h1>
<p class="text-texto-escuro/70 mt-1">Junte-se a nós para cuidar melhor dos seus amigos peludos!</p>
</div>

<!-- Cartão do Formulário -->
<!-- Borda usa a cor principal meiga: destaque-meigo -->
<div class="bg-white p-8 rounded-xl shadow-2xl border-t-4 border-destaque-meigo">

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Campo Nome -->
        <div class="mb-5">
            <label for="name" class="block text-sm font-medium text-texto-escuro mb-1">Seu Nome</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50 @error('name') border-red-500 @enderror"
                   placeholder="Ex: Ana Luiza">
            @error('name')
                <span class="text-red-500 text-sm mt-1 block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo E-mail -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-texto-escuro mb-1">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50 @error('email') border-red-500 @enderror"
                   placeholder="seu.email@exemplo.com">
            @error('email')
                <span class="text-red-500 text-sm mt-1 block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo Senha -->
        <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-texto-escuro mb-1">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50 @error('password') border-red-500 @enderror"
                   placeholder="Mínimo 8 caracteres">
            @error('password')
                <span class="text-red-500 text-sm mt-1 block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo Confirmação de Senha -->
        <div class="mb-6">
            <label for="password-confirm" class="block text-sm font-medium text-texto-escuro mb-1">Confirmar Senha</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50"
                   placeholder="Confirme sua senha">
        </div>

        <!-- Botão de Registro -->
        <!-- Botão usa a cor principal meiga: destaque-meigo -->
        <button type="submit" class="w-full flex items-center justify-center py-3 bg-destaque-meigo text-white rounded-xl font-bold text-lg shadow-md hover:bg-destaque-meigo/90 transition duration-300">
            <i class="fas fa-paw mr-2"></i> Cadastrar
        </button>
    </form>
</div>

<!-- Link para Login -->
<div class="mt-4 text-center">
    <p class="text-sm text-texto-escuro/80">
        Já tem uma conta?
        <!-- Link usa a cor azul-bebe e hover na cor principal meiga -->
        <a class="text-azul-bebe hover:text-destaque-meigo transition duration-150 font-semibold" href="{{ route('login') }}">
            Faça login aqui
        </a>
    </p>
</div>


</div>

@endsection
