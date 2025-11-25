<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConsultaController extends Controller
{
    /**
     * Mostra o formulário para adicionar uma nova consulta a um pet específico.
     * @param Pet $pet O pet ao qual a consulta será adicionada.
     */
    public function create(Pet $pet)
    {
        // 1. Verificação de Propriedade (Segurança)
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        // Retorna a view do formulário, passando o objeto Pet.
        return view('consultas.create', compact('pet'));
    }

    /**
     * Armazena uma nova consulta no banco de dados para o pet especificado.
     * @param Request $request Os dados do formulário.
     * @param Pet $pet O pet ao qual a consulta será vinculada.
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
                'data_consulta' => 'required|date',
                'motivo' => 'required|string|max:255',
                'observacoes' => 'nullable|string', // Campo de texto longo
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        // 3. Vinculação e Criação
        // Cria a consulta usando o relacionamento do Pet
        $pet->consultas()->create($validatedData);

        // 4. Redirecionamento com feedback
        return redirect()->route('pets.show', $pet->id)->with('success', 'Consulta registrada com sucesso!');
    }

    /**
     * Remove o registro de uma consulta específica.
     * @param Pet $pet (Injetado pela rota, mas não usado diretamente, apenas para escopo)
     * @param Consulta $consulta A consulta a ser deletada.
     */
    public function destroy(Pet $pet, Consulta $consulta)
    {
        // 1. Verificação de Propriedade (Segurança Dupla)
        // Garante que o usuário logado é o dono do pet E que a consulta pertence a esse pet.
        if ($consulta->pet->user_id !== Auth::id() || $consulta->pet_id !== $pet->id) {
            abort(403, 'Acesso não autorizado.');
        }

        // 2. Remoção no PostgreSQL
        $consulta->delete();

        // 3. Redirecionamento
        return redirect()->route('pets.show', $pet->id)->with('success', 'Registro de consulta removido.');
    }
}
