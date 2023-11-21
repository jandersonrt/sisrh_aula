@extends('layouts.default')

@section('title', 'Cargos - SIS ')

@section('content')
     <x-btn-create>
        <x-slot name="route">{{ route('cargos.create') }}</x-slot>
        <x-slot name="title">Cadastrar Cargo</x-slot>
     </x-btn-create>

    <h1 class="f-2 mb-3">Cargos</h1>

    <p>Total de Cargos: {{ $totalCargos }}</p>

    @if (Session::get('sucesso'))
     <div class="alert alert-success text-center">{{ Session::get('sucesso') }}</div>
    @endif

    <x-busca>
        <x-slot name="rota">{{ route('cargos.index') }}</x-slot>
        <x-slot name="tipo">Cargo</x-slot>
    </x-busca>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Cargo</th>
                <th scope="col" width="100">Funcionários</th>
                <th scope="col" width="110">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
                <tr class="align-middle">
                    <th scope="row" class="text-center">{{ $cargo->id }}</th>
                    <td class="text-center">{{ $cargo->descricao }}</td>
                    <td class="text-center" class="text-center">{{ $cargo->funcionariosAtivos->count() }}</td>
                    <td>
                        <a href="{{ route('cargos.edit', $cargo->id) }}" title="Editar" class="btn btn-primary"> <i class="bi bi-pen"></i></a>
                        <a href="cargos.destroy" title="Deletar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $cargo->id }}"><i class="bi bi-trash"></i></a>
                        {{-- Inserir o componente modal na view --}}
                        <x-modal-delete>
                            <x-slot name="id">{{ $cargo->id }}</x-slot>
                            <x-slot name="tipo">Cargo</x-slot>
                            <x-slot name="nome">{{ $cargo->descricao }}</x-slot>
                            <x-slot name="rota">cargos.destroy</x-slot>
                        </x-modal-delete>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <style>
        .pagination{
            justify-content: center;
        }
    </style>
    {{ $cargos->links() }}

@endsection
