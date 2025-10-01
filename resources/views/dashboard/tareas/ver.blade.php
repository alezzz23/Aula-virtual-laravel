@extends('layouts.app')

@section('title', 'Tareas - ' . $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Tareas - {{ $materia->materia }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
            <a href="{{ route('tareas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Tarea
            </a>
        @endif
    </div>

    <div class="row">
        @forelse($tareas as $tarea)
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">{{ $tarea->tarea }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $tarea->descripcion ?? 'Sin descripción' }}</p>
                        
                        <div class="row mt-2">
                            <div class="col-6">
                                <small class="text-muted">
                                    <i class="fas fa-bookmark"></i> {{ $tarea->lapso }}
                                </small>
                            </div>
                            @if($tarea->fecha_entrega)
                                <div class="col-6 text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}
                                    </small>
                                </div>
                            @endif
                        </div>

                        @if($tarea->archivo)
                            <a href="{{ asset('storage/tareas/' . $tarea->archivo) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-download"></i> Descargar
                            </a>
                        @endif

                        @if(auth()->user()->isEstudiante() && auth()->user()->enviar_tareas)
                            <button type="button" class="btn btn-sm btn-success mt-2" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#enviarTareaModal{{ $tarea->id }}">
                                <i class="fas fa-upload"></i> Enviar Tarea
                            </button>
                        @endif

                        @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
                            <a href="{{ route('tareas.show', $tarea) }}" class="btn btn-sm btn-info mt-2">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Modal Enviar Tarea -->
                @if(auth()->user()->isEstudiante() && auth()->user()->enviar_tareas)
                    <div class="modal fade" id="enviarTareaModal{{ $tarea->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('tareas.enviar') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="idMa" value="{{ $materia->id }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Enviar Tarea: {{ $tarea->tarea }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre del Envío *</label>
                                            <input type="text" class="form-control" name="nombre" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descripción *</label>
                                            <textarea class="form-control" name="descripcion" maxlength="70" rows="2" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Archivo *</label>
                                            <input type="file" class="form-control" name="ruta" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay tareas disponibles para esta materia.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

