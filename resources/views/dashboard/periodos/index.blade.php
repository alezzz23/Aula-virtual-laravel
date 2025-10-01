@extends('layouts.app')

@section('title', 'Períodos Académicos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Períodos Académicos
        </h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearPeriodoModal">
            <i class="fas fa-plus"></i> Nuevo Período
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Períodos Registrados</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Período</th>
                            <th>Fecha de Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($periodos as $periodo)
                            <tr>
                                <td><strong>{{ $periodo->periodo }}</strong></td>
                                <td>{{ $periodo->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('periodos.destroy', $periodo) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Eliminar este período? Esto también eliminará las notas asociadas.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay períodos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Período -->
<div class="modal fade" id="crearPeriodoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('periodos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Período Académico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre del Período *</label>
                        <input type="text" class="form-control" name="periodo" 
                               placeholder="Ejemplo: 2024-2025" required>
                        <small class="text-muted">Formato recomendado: Año-Año o Período descriptivo</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Período</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

