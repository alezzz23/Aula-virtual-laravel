@extends('layouts.app')

@section('title', 'Materias')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Materias</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearMateriaModal">
            <i class="fas fa-plus"></i> Nueva Materia
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Materias Activas ({{ $materias->count() }})</h5>
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
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Curso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaMaterias">
                        @forelse($materias as $materia)
                            <tr>
                                <td><strong>{{ $materia->materia }}</strong></td>
                                <td>{{ $materia->profesor->namefull ?? 'Sin asignar' }}</td>
                                <td>{{ $materia->curso->seccion ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('materias.show', $materia) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('materias.edit', $materia) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('materias.destroy', $materia) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Deshabilitar esta materia?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay materias registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Materia -->
<div class="modal fade" id="crearMateriaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('materias.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Materia *</label>
                        <input type="text" class="form-control" name="materia" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Curso *</label>
                        <select class="form-select" name="curso" required>
                            <option value="">Seleccione un curso...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->seccion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profesor *</label>
                        <select class="form-select" name="profesor" required>
                            <option value="">Seleccione un profesor...</option>
                            @foreach($profesores as $profesor)
                                <option value="{{ $profesor->id }}">{{ $profesor->namefull }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Materia</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('buscar').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaMaterias tr');
        
        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection

