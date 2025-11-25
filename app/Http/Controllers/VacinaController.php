<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VacinaController extends Controller
{
    /**
     * Mostra o formulário para adicionar uma nova vacina a um pet específico.
     * @param Pet $pet O pet ao qual a vacina será adicionada (injetado pela rota).
     */
    public function create(Pet $pet)
    {
        // 1. Verificação de Propriedade (Segurança)
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        // Retorna a view do formulário, passando o objeto Pet.
        return view('vacinas.create', compact('pet'));
    }

    /**
     * Armazena uma nova vacina no banco de dados para o pet especificado.
     * @param Request $request Os dados do formulário.
     * @param Pet $pet O pet ao qual a vacina será vinculada.
     */
    public function store(Request $request, Pet $pet)
    {
        // 1. Verificação de Propriedade (Segurança)
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
        
        // 2. Validação dos Dados
        try {
            $validatedData = $request->validate([
                'descricao' => 'required|string|max:255',
                'data_aplicada' => 'required|date|before_or_equal:today', // Não pode ser no futuro
                'proxima_dose' => 'nullable|date|after_or_equal:data_aplicada', // Deve ser depois da data de aplicação
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        // 3. Vinculação e Criação
        // Cria a vacina usando o relacionamento do Pet (mais limpo e seguro)
        $pet->vacinas()->create($validatedData);

        // 4. Redirecionamento com feedback
        return redirect()->route('pets.show', $pet->id)->with('success', 'Vacina registrada com sucesso!');
    }

    /**
     * Remove o registro de uma vacina específica.
     * @param Pet $pet (Injetado pela rota, mas não usado diretamente, apenas para escopo)
     * @param Vacina $vacina A vacina a ser deletada.
     */
    public function destroy(Pet $pet, Vacina $vacina)
    {
        // 1. Verificação de Propriedade (Segurança Dupla)
        // Garante que o usuário logado é o dono do pet E que a vacina pertence a esse pet.
        if ($vacina->pet->user_id !== Auth::id() || $vacina->pet_id !== $pet->id) {
            abort(403, 'Acesso não autorizado.');
        }

        // 2. Remoção no PostgreSQL
        $vacina->delete();
        
        // 3. Redirecionamento
        return redirect()->route('pets.show', $pet->id)->with('success', 'Registro de vacina removido.');
    }
}