<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados de entrada
        $validatedData = $request->validate([
            'nome' => 'required|string|max:70',
            'tipo' => 'required|string|in:PF,PJ', // Assumindo 'PF' ou 'PJ'
            'cpf_cnpj' => 'required|string|max:20',
            'ci' => 'nullable|string|max:15',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:70',
            'cidade' => 'nullable|string|max:70',
            'estado' => 'nullable|string|max:2',
            'cep' => 'nullable|string|max:12',
            'referencia' => 'nullable|string|max:15',
            'tel1' => 'required|string|max:15',
            'tel2' => 'nullable|string|max:15',
            'obs' => 'nullable|string|max:255',
        ]);

        // 2. Criação do cliente no banco de dados
        $cliente = Cliente::create($validatedData);

        // 3. Redireciona com uma mensagem de sucesso
        return redirect()->route('clientes.show', $cliente)
        ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
