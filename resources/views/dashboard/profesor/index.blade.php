@extends('layouts.app')

@section('title', 'Dashboard Profesor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-chalkboard-teacher"></i> Dashboard - Profesor</h1>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0"><i class="fas fa-book"></i> Mis Materias</h5>
            </div>
            <div class="card-body">
                @forelse($materias as $materia)
                    <div class="mb-3">
                        <h6>
                            <a href="{{ route('materias.show', $materia) }}">
                                {{ $materia->materia }}
                            </a>
                        </h6>
                        <p class="mb-1 text-muted">
                            <i class="fas fa-school"></i> {{ $materia->curso->seccion }}
                        </p>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('asistencia.materia', $materia) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-clipboard-check"></i> Asistencia
                            </a>
                            <a href="{{ route('notas.materia', $materia) }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-graduation-cap"></i> Notas
                            </a>
                            <a href="{{ route('materias.tareas', $materia) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-tasks"></i> Tareas
                            </a>
                        </div>
                        <hr>
                    </div>
                @empty
                    <p class="text-muted">No tienes materias asignadas.</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        @if($cursosGuia->count() > 0)
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0"><i class="fas fa-users"></i> Cursos como Profesor Guía</h5>
            </div>
            <div class="card-body">
                @foreach($cursosGuia as $profGuia)
                    <div class="mb-2">
                        <h6>
                            <a href="{{ route('cursos.show', $profGuia->curso) }}">
                                {{ $profGuia->curso->seccion }}
                            </a>
                        </h6>
                        <a href="{{ route('cursos.alumnos', $profGuia->curso) }}" class="btn btn-sm btn-outline-primary">
                            Ver Alumnos
                        </a>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0"><i class="fas fa-calendar-alt"></i> Próximas Fechas</h5>
            </div>
            <div class="card-body">
                @forelse($fechas as $fecha)
                    <div class="mb-3">
                        <h6>{{ $fecha->informacion }}</h6>
                        @if($fecha->lapso)
                            <span class="badge bg-secondary">{{ $fecha->lapso }}</span>
                        @endif
                        <p class="text-muted small mb-0">
                            <i class="fas fa-clock"></i> {{ $fecha->fecha->format('d/m/Y H:i') }}
                        </p>
                        <hr>
                    </div>
                @empty
                    <p class="text-muted">No hay fechas programadas.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-newspaper"></i> Eventos y Publicaciones</h5>
    </div>
    <div class="card-body">
        @forelse($eventos as $evento)
            <div class="mb-4">
                <h5>{{ $evento->titulo }}</h5>
                <p class="text-justify">{{ $evento->descripcion }}</p>
                
                @if($evento->esImagen())
                    <img src="{{ asset('storage/eventos/' . $evento->archivo) }}" 
                         alt="{{ $evento->titulo }}" 
                         class="img-fluid rounded mb-2">
                @elseif($evento->esVideo())
                    <video src="{{ asset('storage/eventos/' . $evento->archivo) }}" 
                           controls 
                           class="img-fluid rounded mb-2"></video>
                @endif
                
                <p class="text-muted small">
                    <i class="fas fa-calendar"></i> {{ $evento->fecha->format('d/m/Y H:i') }}
                </p>
                <hr>
            </div>
        @empty
            <p class="text-muted">No hay eventos publicados.</p>
        @endforelse
    </div>
</div>
@endsection

