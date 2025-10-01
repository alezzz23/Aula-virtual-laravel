@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard - Administrador</h1>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Estudiantes</h6>
                        <h2 class="mb-0">{{ $totalEstudiantes }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-user-graduate fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('estudiantes.index') }}" class="text-white text-decoration-none">
                    Ver todos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Profesores</h6>
                        <h2 class="mb-0">{{ $totalProfesores }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-chalkboard-teacher fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('profesores.index') }}" class="text-white text-decoration-none">
                    Ver todos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Cursos</h6>
                        <h2 class="mb-0">{{ $totalCursos }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-school fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('cursos.index') }}" class="text-white text-decoration-none">
                    Ver todos <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Materias</h6>
                        <h2 class="mb-0">{{ $totalMaterias }}</h2>
                    </div>
                    <div>
                        <i class="fas fa-book fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('materias.index') }}" class="text-white text-decoration-none">
                    Ver todas <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
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
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
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
@endsection

