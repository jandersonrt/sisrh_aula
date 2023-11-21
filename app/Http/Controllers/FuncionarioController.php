<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Models\Departamento;
use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FuncionarioController extends Controller
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
        $funcionarios = Funcionario::where('nome', 'like', '%'.$request->busca.'%')->orderby('nome', 'asc')->paginate(3);

        $totalFuncionarios = Funcionario::all()->count();

        // Receber os dados do banco através do model
        return view('funcionarios.index', compact('funcionarios', 'totalFuncionarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Retornar o formulário do Cadastro de funcionário
        $departamentos = Departamento::all()->sortBy('nome');
        $cargos = Cargo::all()->sortBy('descricao');
        $beneficios = Beneficio::where('status','on')->orderby('descricao')->get();
        return view('funcionarios.create', compact('departamentos','cargos','beneficios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->toArray();
        // dd($input);

        $input['user_id'] = auth()->user()->id;

        if($request->hasFile('foto')) {
            $input['foto'] = $this->uploadFoto($request->foto);
        }

        // Insert de dados do usuário no banco
        $funcionario = Funcionario::create($input);

        if($request->beneficios){
            $funcionario->beneficios()->attach($request->beneficios);
        }

        return redirect()->route('funcionarios.index')->with('sucesso','Funcionário Cadastrado com Sucesso');
    }
    // Função para redimensionar e realizar o upload da foto
    private function uploadFoto($foto) {
        $nomeArquivo = $foto->hashName();

        //Redimensionar foto
        $imagem = Image::make($foto)->fit(200,200);
        //Salvar arquivo da foto
        Storage::put('public/funcionarios/'.$nomeArquivo, $imagem->encode());
        // Upload sem redimensionar
        // $foto->store('public/funcionarios/');

        return $nomeArquivo;
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
        $funcionario = Funcionario::find($id);

        if(!$funcionario) {
            return back();
        }

        $departamentos = Departamento::all()->sortBy('nome');
        $cargos = Cargo::all()->sortBy('descricao');
        $beneficios = Beneficio::where('status','on')->orderby('descricao')->get();

        $beneficio_selecionados = [];

        foreach($funcionario->beneficios as $beneficio_selecionado){
            $beneficio_selecionados[] = $beneficio_selecionado->id;
        }

        return view('funcionarios.edit', compact('funcionario', 'departamentos', 'cargos', 'beneficios', 'beneficio_selecionados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray();

        $funcionario = Funcionario::find($id);

        if($request->hasFile('foto')) {
            Storage::delete('public/funcionarios/'.$funcionario['foto']);
            $input['foto'] = $this->uploadFoto($request->foto);
        }

        if($request->beneficios){
            $funcionario->beneficios()->sync($input['beneficios']);
        }

        $funcionario->fill($input);
        $funcionario->save();
        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $funcionario = Funcionario::find($id);
        // dd($funcionario);

        //Exclui a foto do funcionário
        if($funcionario['foto'] != null) {
            Storage::delete('public/funcionarios/'.$funcionario['foto']);
        }
        //Apagando o registro no banco de dados
        $funcionario->delete();

        return redirect()->route('funcionarios.index')->with('sucesso', 'Funcionário excluido com sucesso.');
    }
}
