@extends('layouts.default')

@section('title', 'Usuários - SIS ')

@section('content')
     <x-btn-create>
        <x-slot name="route">{{ route('usuarios.create') }}</x-slot>
        <x-slot name="title">Cadastrar Usuário</x-slot>
     </x-btn-create>

    <h1 class="f-2 mb-3">Usuários</h1>

    @if (Session::get('sucesso'))
     <div class="alert alert-success text-center">{{ Session::get('sucesso') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Senha</th>
                <th scope="col">Tipo</th>
                <th scope="col" width="110">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr class="align-middle">
                    <th scope="row" class="text-center">{{ $usuario->id }}</th>
                    <td class="text-center">{{ $usuario->name }}</td>
                    <td class="text-center">{{ $usuario->email }}</td>
                    <td class="text-center">{{ $usuario->password }}</td>
                    <td class="text-center">{{ $usuario->tipo }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" title="Editar" class="btn btn-primary"> <i class="bi bi-pen"></i></a>
                        <a href="" title="Deletar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-#"><i class="bi bi-trash"></i></a>
                        {{-- Inserir o componente modal na view --}}
                        <x-modal-delete>
                            <x-slot name="id">{{ $usuario->id }}</x-slot>
                            <x-slot name="tipo">Usuario</x-slot>
                            <x-slot name="nome">{{ $usuario->name }}</x-slot>
                            <x-slot name="rota">usuarios.destroy</x-slot>
                        </x-modal-delete>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
