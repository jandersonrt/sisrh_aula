@extends('layouts.default')

@section('title', 'Cadastro de Departamento - SISRH ')

@section('content')
    <h1 class="fs-2 mb-3">Cadastro de Departamentos</h1>

    <form class="row g-3" method="POST" action="{{ route('departamentos.store') }}" enctype="multipart/form-data">
        {{-- Criar hash de segurança para submissão do formulário --}}
        @csrf
        @include('departamentos.partials.form')
      <!--Sistema de grid: col-md-6(2, 4, 6, 12)-->
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Cadastrar</button>
          <a href="{{ route('departamentos.index') }}" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
@endsection
