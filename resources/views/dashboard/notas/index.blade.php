@extends('layouts.app')

@section('title', 'Gestión de Notas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Notas</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">Selecciona un curso para gestionar las notas de sus estudiantes.</p>
            
            <div class="row">
                @forelse($cursos as $curso)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $curso->seccion }}</h5>
                                <p class="card-text text-muted">
                                    <i class="fas fa-users"></i> {{ $curso->alumnos->count() }} estudiantes<br>
                                    <i class="fas fa-book"></i> {{ $curso->materias->count() }} materias
                                </p>
                                <a href="{{ route('notas.curso', $curso) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-graduation-cap"></i> Ver Materias
                                </a>
                                <a href="{{ route('notas.deficientes', $curso) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i> Deficientes
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay cursos disponibles.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

