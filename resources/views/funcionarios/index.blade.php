@extends('layouts.default')

@section('title', 'SisRH - funcionários')

@section('content')
    <x-btn-create/>
    <h1 class="fs-2 mb-3">Lista Funcionários</h1>

    <table class="table table-striped">
        <thead class="table-dark">
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Cargo</th>
            <th scope="col">Departamento</th>
            <th scope="col" width="120px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Foto</td>
            <td>Edemilton</td>
            <td>Professor</td>
            <td>Sistema de Informação</td>
            <td>
                <a href="" title="Editar" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                <a href="" title="Deletar" class="btn btn-danger"><i class="bi bi-trash"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
@endsection