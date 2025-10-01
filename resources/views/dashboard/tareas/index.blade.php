@extends('layouts.app')

@section('title', 'Gestión de Tareas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Tareas</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearTareaModal">
            <i class="fas fa-plus"></i> Nueva Tarea
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Tareas Activas</h5>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar tarea...">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tarea</th>
                            <th>Materia</th>
                            <th>Lapso</th>
                            <th>Fecha de Entrega</th>
                            <th>Entregas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaTareas">
                        @forelse($tareas as $tarea)
                            <tr>
                                <td><strong>{{ $tarea->tarea }}</strong></td>
                                <td>{{ $tarea->materia->materia ?? '-' }}</td>
                                <td>{{ $tarea->lapso }}</td>
                                <td>{{ $tarea->fecha_entrega ? \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $tarea->tareasImg->count() }} enviadas</span>
                                </td>
                                <td>
                                    <a href="{{ route('tareas.show', $tarea) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('materias.tareas-enviadas', $tarea->materia) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-folder-open"></i> Ver Entregas
                                    </a>
                                    <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Eliminar esta tarea?')">
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
                                <td colspan="6" class="text-center">No hay tareas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Tarea -->
<div class="modal fade" id="crearTareaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('tareas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Título de la Tarea *</label>
                        <input type="text" class="form-control" name="tarea" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Materia *</label>
                                <select class="form-select" name="idMa" required>
                                    <option value="">Seleccione una materia...</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia->id }}">
                                            {{ $materia->materia }} - {{ $materia->curso->seccion ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lapso *</label>
                                <select class="form-select" name="lapso" required>
                                    <option value="1er Lapso">1er Lapso</option>
                                    <option value="2do Lapso">2do Lapso</option>
                                    <option value="3er Lapso">3er Lapso</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" name="fecha_entrega">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Archivo Adjunto</label>
                        <input type="file" class="form-control" name="archivo">
                        <small class="text-muted">Opcional: PDF, Word, imagen, etc.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Tarea</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('buscar').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaTareas tr');
        
        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection

