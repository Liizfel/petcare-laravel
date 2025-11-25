@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-12 sm:mt-20">
<div class="text-center mb-8">
<!-- Ícone agora usa a cor principal meiga: destaque-meigo -->
<i class="fas fa-paw text-destaque-meigo text-5xl mb-3"></i>
<h1 class="text-3xl font-extrabold text-texto-escuro">Bem-vindo(a) ao PetCare!</h1>
<p class="text-texto-escuro/70 mt-1">Faça login para gerenciar a agenda dos seus pets.</p>
</div>

<!-- Cartão do Formulário -->
<!-- Borda agora usa a cor principal meiga: destaque-meigo -->
<div class="bg-white p-8 rounded-xl shadow-2xl border-t-4 border-destaque-meigo">

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Campo E-mail -->
        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-texto-escuro mb-1">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50 @error('email') border-red-500 @enderror"
                   placeholder="seu.email@exemplo.com">
            @error('email')
                <span class="text-red-500 text-sm mt-1 block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo Senha -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-texto-escuro mb-1">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-4 py-3 border border-bege-suave rounded-lg focus:ring-destaque-meigo focus:border-destaque-meigo transition duration-150 bg-fundo-pastel/50 @error('password') border-red-500 @enderror"
                   placeholder="Sua senha secreta">
            @error('password')
                <span class="text-red-500 text-sm mt-1 block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Checkbox Lembrar-me e Link de Senha -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <!-- Checkbox agora usa a cor meiga -->
                <input class="form-checkbox h-4 w-4 text-destaque-meigo border-gray-300 rounded focus:ring-destaque-meigo" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="ml-2 block text-sm text-texto-escuro" for="remember">
                    Lembrar-me
                </label>
            </div>

            @if (Route::has('password.request'))
                <!-- Link de senha agora usa o azul bebe e hover meigo -->
                <a class="text-sm text-azul-bebe hover:text-destaque-meigo transition duration-150" href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif
        </div>

        <!-- Botão de Login -->
        <!-- Botão usa a cor principal meiga: destaque-meigo -->
        <button type="submit" class="w-full flex items-center justify-center py-3 bg-destaque-meigo text-white rounded-xl font-bold text-lg shadow-md hover:bg-destaque-meigo/90 transition duration-300">
            <i class="fas fa-sign-in-alt mr-2"></i> Entrar
        </button>
    </form>
</div>

<!-- Link para Registro -->
@if (Route::has('register'))
    <div class="mt-4 text-center">
        <p class="text-sm text-texto-escuro/80">
            Não tem uma conta?
            <!-- Link de registro agora usa o azul bebe e hover meigo -->
            <a class="text-azul-bebe hover:text-destaque-meigo transition duration-150 font-semibold" href="{{ route('register') }}">
                Cadastre-se aqui
            </a>
        </p>
    </div>
@endif


</div>

@endsection
