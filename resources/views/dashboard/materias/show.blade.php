@extends('layouts.app')

@section('title', $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $materia->materia }}
        </h1>
        <span class="badge bg-info">{{ $materia->curso->seccion ?? '' }}</span>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información</h5>
                </div>
                <div class="card-body">
                    <p><strong>Profesor:</strong><br>{{ $materia->profesor->namefull ?? 'Sin asignar' }}</p>
                    <p><strong>Curso:</strong><br>{{ $materia->curso->seccion ?? '-' }}</p>
                    <p><strong>Estado:</strong><br>
                        @if($materia->estado)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-danger">Inactiva</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('materias.actividades', $materia) }}" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-tasks"></i> Ver Actividades
                    </a>
                    <a href="{{ route('reportes.index', $materia) }}" class="btn btn-info w-100 mb-2">
                        <i class="fas fa-comments"></i> Comentarios
                    </a>
                    @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
                        <a href="{{ route('asistencia.materia', $materia) }}" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-clipboard-check"></i> Asistencia
                        </a>
                        <a href="{{ route('notas.materia', $materia) }}" class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-graduation-cap"></i> Notas
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-folder-open"></i> Recursos de la Materia</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6><i class="fas fa-file-alt"></i> Clases</h6>
                                    <p class="mb-0">{{ $materia->clases->count() }} archivos</p>
                                    <a href="{{ route('materias.clases', $materia) }}" class="btn btn-light btn-sm mt-2">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h6><i class="fas fa-video"></i> Videos</h6>
                                    <p class="mb-0">{{ $materia->videos->count() }} videos</p>
                                    <a href="{{ route('materias.videos', $materia) }}" class="btn btn-light btn-sm mt-2">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6><i class="fas fa-link"></i> Enlaces</h6>
                                    <p class="mb-0">{{ $materia->enlaces->count() }} enlaces</p>
                                    <a href="{{ route('materias.enlaces', $materia) }}" class="btn btn-light btn-sm mt-2">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h6><i class="fas fa-book"></i> Guías</h6>
                                    <p class="mb-0">{{ $materia->guias->count() }} guías</p>
                                    <a href="{{ route('materias.guias', $materia) }}" class="btn btn-light btn-sm mt-2">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6><i class="fas fa-clipboard-list"></i> Planes</h6>
                                    <p class="mb-0">{{ $materia->planes->count() }} planes</p>
                                    <a href="{{ route('materias.planes', $materia) }}" class="btn btn-light btn-sm mt-2">Ver</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card bg-secondary text-white">
                                <div class="card-body">
                                    <h6><i class="fas fa-tasks"></i> Tareas</h6>
                                    <p class="mb-0">{{ $materia->tareas->count() }} tareas</p>
                                    <a href="{{ route('materias.tareas', $materia) }}" class="btn btn-light btn-sm mt-2">Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

