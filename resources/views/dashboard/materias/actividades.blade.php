@extends('layouts.app')

@section('title', 'Actividades - ' . $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Actividades - {{ $materia->materia }}
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-file-alt"></i> Clases</h5>
                </div>
                <div class="card-body">
                    @forelse($materia->clases as $clase)
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                            <div>
                                <i class="fas fa-file-pdf text-danger"></i>
                                <strong>{{ $clase->nombre }}</strong>
                            </div>
                            <a href="{{ asset('storage/' . $clase->archivo) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i> Descargar
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No hay clases disponibles</p>
                    @endforelse
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-video"></i> Videos</h5>
                </div>
                <div class="card-body">
                    @forelse($materia->videos as $video)
                        <div class="border-bottom pb-2 mb-2">
                            <strong>{{ $video->nombre }}</strong><br>
                            <a href="{{ $video->enlace }}" target="_blank" class="btn btn-sm btn-danger mt-1">
                                <i class="fas fa-play"></i> Ver Video
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No hay videos disponibles</p>
                    @endforelse
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-link"></i> Enlaces</h5>
                </div>
                <div class="card-body">
                    @forelse($materia->enlaces as $enlace)
                        <div class="border-bottom pb-2 mb-2">
                            <strong>{{ $enlace->nombre }}</strong><br>
                            <a href="{{ $enlace->enlace }}" target="_blank" class="btn btn-sm btn-success mt-1">
                                <i class="fas fa-external-link-alt"></i> Abrir Enlace
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No hay enlaces disponibles</p>
                    @endforelse
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Guías</h5>
                </div>
                <div class="card-body">
                    @forelse($materia->guias as $guia)
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                            <div>
                                <i class="fas fa-file-pdf text-danger"></i>
                                <strong>{{ $guia->nombre }}</strong>
                            </div>
                            <a href="{{ asset('storage/' . $guia->archivo) }}" target="_blank" class="btn btn-sm btn-warning">
                                <i class="fas fa-download"></i> Descargar
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No hay guías disponibles</p>
                    @endforelse
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Planes de Clase</h5>
                </div>
                <div class="card-body">
                    @forelse($materia->planes as $plan)
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                            <div>
                                <i class="fas fa-file-pdf text-danger"></i>
                                <strong>{{ $plan->nombre }}</strong>
                            </div>
                            <a href="{{ asset('storage/' . $plan->archivo) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-download"></i> Descargar
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No hay planes disponibles</p>
                    @endforelse
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-tasks"></i> Tareas</h5>
                </div>
                <div class="card-body">
                    @forelse($materia->tareas as $tarea)
                        <div class="border-bottom pb-2 mb-2">
                            <strong>{{ $tarea->tarea }}</strong>
                            <p class="mb-1 text-muted small">{{ $tarea->descripcion }}</p>
                            <span class="badge bg-secondary">Lapso: {{ $tarea->lapso }}</span>
                            <a href="{{ route('materias.tareas', $materia) }}" class="btn btn-sm btn-secondary mt-1">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                        </div>
                    @empty
                        <p class="text-muted">No hay tareas disponibles</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

