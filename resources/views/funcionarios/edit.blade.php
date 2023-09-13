@extends('layouts.default')

@section('title', 'Cadastro de Funcionário - SISRH ')

@section('content')
    <h1 class="fs-2 mb-3">Alterar Funcionário</h1>

    <form class="row g-3" method="POST" action="{{ route('funcionarios.update', $funcionario->id) }}" enctype="multipart/form-data">
        {{-- Criar hash de segurança para submissão do formulário --}}
        @csrf
        @method('PUT')
        @include('funcionarios.partials.form')
      <!--Sistema de grid: col-md-6(2, 4, 6, 12)-->
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Cadastrar</button>
          <a href="{{ route('funcionarios.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
@endsection
