<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('tipo-user')){
            $usuarios = User::all()->sortBy('name');
       
        return view('usuarios.index', compact('usuarios'));
    }else{
        return back();
    }
    }
        


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Gate::allows('tipo-user')){
        //Retornar o formulário do Cadastro de Usuario
        return view('usuarios.create');
    }else{
        return back();
    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Gate::allows('tipo-user')){
        $input = $request->toArray(); //Array que recebe os valores dos campos da view através do objeto request

        $input['password'] = bcrypt($input['password']); // Linha que criptografa a senha do usuário com o método bcrypt, antes de guardar no banco

        // Insert de dados do usuário no banco
        User::create($input);

        return redirect()->route('usuarios.index')->with('sucesso','Usuário Cadastrado com Sucesso');
    }else{
        return back();
    }
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
        $usuario = User::find($id);

        if(!$usuario) {
            return back();
        }

        if(auth()->user()->id == $usuario['id']|| auth()->user()->type == 'admin'){
            return view('usuarios.edit', compact('usuario'));
        } else{
            return back();
        }
        
            
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->toArray(); //Array que recebe os valores dos campos da view através do objeto request

        $usuario = User::find($id);

        //O código abaixo verifica se o usuário informou uma nova senha na view “edit”, se sim, ele realiza a criptografia e em seguida efetua o armazenamento no banco.
        if($input['password'] != null){
            $input['password'] = bcrypt($input['password']);
        }else{
            $input['password'] = $usuario['password'];
        }

        $usuario->fill($input);
        $usuario->save();
        if($usuario->type == "admin"){
            return redirect()->route('usuarios.index')->with('sucesso', 'Usuário alterado com sucesso!');

        }else{
            return redirect()->route('usuarios.edit', $usuario->id)->with('sucesso', 'Usuário alterado com sucesso!');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::find($id);
        // dd($funcionario);

        //Apagando o registro no banco de dados
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('sucesso', 'Usuário excluido com sucesso.');
    }
}
