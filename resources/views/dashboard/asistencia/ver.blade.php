@extends('layouts.app')

@section('title', 'Historial de Asistencia')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('asistencia.materia', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Historial de Asistencia - {{ $materia->materia }}
        </h1>
    </div>

    @if($asistencias->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No hay registros de asistencia para esta materia.
        </div>
    @else
        @foreach($asistencias as $numeroRegistro => $asistenciasPorRegistro)
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Registro #{{ $numeroRegistro }}
                        <small class="text-muted">
                            ({{ $asistenciasPorRegistro->first()->fecha->format('d/m/Y H:i') }})
                        </small>
                    </h5>
                    <form action="{{ route('asistencia.eliminar', $asistenciasPorRegistro->first()) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Eliminar este registro completo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar Registro
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Estado</th>
                                    <th>Comentario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asistenciasPorRegistro as $asistencia)
                                    <tr>
                                        <td>{{ $asistencia->usuario->namefull }}</td>
                                        <td>
                                            @if($asistencia->asistencia)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Presente
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times"></i> Ausente
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $asistencia->comentario ?? '-' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editModal{{ $asistencia->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal para editar -->
                                    <div class="modal fade" id="editModal{{ $asistencia->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('asistencia.editar', $asistencia) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Asistencia</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Estudiante</label>
                                                            <input type="text" class="form-control" value="{{ $asistencia->usuario->namefull }}" disabled>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Estado</label>
                                                            <div class="btn-group w-100" role="group">
                                                                <input type="radio" class="btn-check" name="asistencia" id="presente{{ $asistencia->id }}" value="1" {{ $asistencia->asistencia ? 'checked' : '' }}>
                                                                <label class="btn btn-outline-success" for="presente{{ $asistencia->id }}">Presente</label>

                                                                <input type="radio" class="btn-check" name="asistencia" id="ausente{{ $asistencia->id }}" value="0" {{ !$asistencia->asistencia ? 'checked' : '' }}>
                                                                <label class="btn btn-outline-danger" for="ausente{{ $asistencia->id }}">Ausente</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Comentario</label>
                                                            <textarea name="comentario" class="form-control" rows="2">{{ $asistencia->comentario }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

