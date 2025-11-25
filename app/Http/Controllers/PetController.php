<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller;
use App\Models\Vacina;
use App\Models\Consulta;

class PetController extends Controller
{
    /**
     * Exibe uma lista de pets (apenas os do usuário logado).
     */
    public function index()
    {
        // Obtém o ID do usuário autenticado.
        $userId = Auth::id();

        // Busca os pets do usuário atual no PostgreSQL.
        $pets = Pet::where('user_id', $userId)->get();

        // Retorna a view 'pets.index' com a lista de pets.
        return view('pets.index', compact('pets'));
    }

    /**
     * Mostra o formulário para criar um novo Pet.
     */
    public function create()
    {
        // Retorna a view do formulário de cadastro.
        return view('pets.create');
    }

    /**
     * Armazena um Pet recém-criado no banco de dados.
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        // 1. Validação dos Dados
        try {
            $validatedData = $request->validate([
                'nome' => 'required|string|max:255',
                'especie' => 'required|string|in:Cachorro,Gato,Outro',
                'idade' => 'required|integer|min:0|max:30',
                'peso' => 'required|numeric|min:0.1|max:200',
                'foto' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        // 2. Adiciona o user_id (Segurança e Vinculação)
        $validatedData['user_id'] = Auth::id();

        // 3. Cria o Pet no PostgreSQL
        Pet::create($validatedData);

        // 4. Redireciona para a lista de Pets com mensagem de sucesso
        return redirect()->route('pets.index')->with('success', 'Pet cadastrado com sucesso!');
    }

    /**
     * Exibe o pet especificado e seus registros relacionados.
     */
    public function show(Pet $pet)
    {
        // 1. Verificação de Propriedade (Segurança)
        // Garante que o usuário logado é o dono do pet, caso contrário, aborta o acesso.
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        // 2. Eager Loading (Otimização)
        // Carrega o Pet com seus relacionamentos 'vacinas' e 'consultas' em uma única consulta.
        $pet->load(['vacinas', 'consultas']);

        // 3. Retorna a View
        return view('pets.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        // Lógica de autorização e retorno da view de edição
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        // Lógica de autorização
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        // 1. Validação dos Dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'especie' => 'required|string|in:Cachorro,Gato,Outro',
            'idade' => 'required|integer|min:0|max:30',
            'peso' => 'required|numeric|min:0.1|max:200',
            'foto' => 'nullable|string',
        ]);

        // 2. Atualiza o Pet no PostgreSQL
        $pet->update($validatedData);

        // 3. Redireciona com mensagem de sucesso
        return redirect()->route('pets.show', $pet->id)->with('success', 'Dados do Pet atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        // Lógica de autorização
        if ($pet->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        // Deleta o Pet. O onDelete('cascade') nas Migrations cuidará de deletar
        // as vacinas e consultas relacionadas no PostgreSQL.
        $pet->delete();

        // Redireciona para a lista de pets.
        return redirect()->route('pets.index')->with('success', 'Pet removido com sucesso!');
    }
}
