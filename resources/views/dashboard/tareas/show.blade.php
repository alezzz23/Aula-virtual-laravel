@extends('layouts.app')

@section('title', 'Ver Tarea')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('tareas.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Detalles de la Tarea
        </h1>
        <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $tarea->tarea }}</h3>
                    <hr>
                    <p><strong>Descripción:</strong></p>
                    <p>{{ $tarea->descripcion ?? 'Sin descripción' }}</p>
                    
                    @if($tarea->archivo)
                        <div class="mt-3">
                            <a href="{{ asset('storage/tareas/' . $tarea->archivo) }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-download"></i> Descargar Archivo Adjunto
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información</h5>
                </div>
                <div class="card-body">
                    <p><strong>Materia:</strong><br>{{ $tarea->materia->materia ?? '-' }}</p>
                    <p><strong>Profesor:</strong><br>{{ $tarea->materia->profesor->namefull ?? '-' }}</p>
                    <p><strong>Lapso:</strong><br>{{ $tarea->lapso ?? '-' }}</p>
                    @if($tarea->fecha_entrega)
                        <p><strong>Fecha de Entrega:</strong><br>{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}</p>
                    @endif
                    <p><strong>Creada:</strong><br>{{ $tarea->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Estadísticas</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tareas Enviadas:</strong><br>
                        <span class="badge bg-info">{{ $tarea->tareasImg->count() }}</span>
                    </p>
                    <a href="{{ route('materias.tareas-enviadas', $tarea->materia) }}" class="btn btn-success btn-sm w-100">
                        <i class="fas fa-folder-open"></i> Ver Entregas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

