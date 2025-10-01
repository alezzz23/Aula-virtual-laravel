@extends('layouts.app')

@section('title', 'Enlaces - ' . $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Enlaces - {{ $materia->materia }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarEnlaceModal">
                <i class="fas fa-plus"></i> Agregar Enlace
            </button>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Enlace</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enlaces as $enlace)
                            <tr>
                                <td><i class="fas fa-link text-success"></i> {{ $enlace->nombre }}</td>
                                <td><small class="text-muted">{{ Str::limit($enlace->enlace, 50) }}</small></td>
                                <td>
                                    <a href="{{ $enlace->enlace }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-external-link-alt"></i> Abrir
                                    </a>
                                    @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
                                        <form action="{{ route('enlaces.destroy', $enlace) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('¿Eliminar este enlace?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay enlaces disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarEnlaceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('materias.enlaces.store', $materia) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Enlace</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL *</label>
                        <input type="url" class="form-control" name="enlace" placeholder="https://..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

