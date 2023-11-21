<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /* Verificar se o usuário estar logado no sistema */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departamentos = Departamento::where('nome', 'like', '%'.$request->busca.'%')->orderby('nome', 'asc')->paginate(3);

        $totalDepartamentos = Departamento::all()->count();

        // Receber os dados do banco através do model
        return view('departamentos.index', compact('departamentos', 'totalDepartamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();
        // dd($input);

        // Inserir os dados do departamento no banco
        Departamento::create($input);

        return redirect()->route('departamentos.index')->with('sucesso','Departamento Cadastrado com Sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departamento = Departamento::find($id);

        if(!$departamento) {
            return back();
        }

        return view('departamentos.edit', compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray();

        $departamento = Departamento::find($id);

        $departamento->fill($input);
        $departamento->save();
        return redirect()->route('departamentos.index')->with('Sucesso', 'Departamento alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departamento = Departamento::find($id);
        // dd($funcionario);

        //Apagando o registro no banco de dados
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('sucesso', 'Departamento excluido com sucesso.');
    }
}
