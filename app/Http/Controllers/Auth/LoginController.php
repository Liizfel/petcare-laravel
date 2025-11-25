<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // IMPORTANTE: Deve usar o Controller base
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller // IMPORTANTE: Deve estender o Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador lida com a autenticação de usuários para a aplicação e
    | o redirecionamento para a tela inicial. Você pode modificar
    | qualquer comportamento facilmente usando traits.
    |
    */

    use AuthenticatesUsers;

    /**
     * Onde redirecionar os usuários após o login.
     * Estamos usando a rota 'dashboard' que você definiu.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Cria uma nova instância do controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // O método middleware() agora funciona corretamente porque a classe estende Controller
        $this->middleware('guest')->except('logout');
    }
}
