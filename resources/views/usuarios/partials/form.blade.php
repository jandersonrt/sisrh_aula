<div class="col-md-6">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name ?? "" }}" required>
</div>

<div class="col-md-4">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email ?? "" }}" required>
</div>

<div class="col-md-4">
    <label for="password" class="form-label">Senha</label>
    <input type="text" class="form-control" id="password" name="password" value="" required>
</div>

@can('tipo_usuario')
    <div class="col-md-4">
        <label for="tipo" class="form-label">Tipo</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value=""></option>
            <option value="admin" @if(isset($usuario->tipo)) @selected($usuario->tipo == 'admin') @endif>Admin</option>
            <option value="usuario" @if(isset($usuario->tipo)) @selected($usuario->tipo == 'usuario') @endif>Usuário</option>
        </select>
    </div>
@endcan
