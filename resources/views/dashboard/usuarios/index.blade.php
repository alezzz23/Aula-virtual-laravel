@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <a href="{{ route('estudiantes.index') }}" class="btn btn-info w-100">
                <i class="fas fa-user-graduate"></i> Estudiantes
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('profesores.index') }}" class="btn btn-success w-100">
                <i class="fas fa-chalkboard-teacher"></i> Profesores
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('docentes.index') }}" class="btn btn-warning w-100">
                <i class="fas fa-users"></i> Docentes
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-user-shield"></i> Administradores
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Usuarios del Sistema</h5>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar...">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Cédula</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaUsuarios">
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->namefull }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $usuario->role->descripcion }}</span>
                                </td>
                                <td>{{ $usuario->cedula }}</td>
                                <td>{{ $usuario->correo }}</td>
                                <td>{{ $usuario->telefono ?? '-' }}</td>
                                <td>
                                    @if($usuario->estado == 'Activo')
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Está seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay usuarios registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('buscar').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaUsuarios tr');
        
        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection

