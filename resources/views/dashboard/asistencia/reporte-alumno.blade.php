@extends('layouts.app')

@section('title', 'Mi Asistencia')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Reporte de Asistencia - {{ $alumno->namefull }}
        </h1>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            @if($asistencias->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay registros de asistencia disponibles.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Materia</th>
                                <th>Curso</th>
                                <th>Registro</th>
                                <th>Estado</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asistencias as $asistencia)
                                <tr>
                                    <td>{{ $asistencia->fecha->format('d/m/Y H:i') }}</td>
                                    <td>{{ $asistencia->materia->materia }}</td>
                                    <td>{{ $asistencia->curso->seccion }}</td>
                                    <td>Registro #{{ $asistencia->registro }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Estadísticas -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Asistencias</h5>
                                <h2>{{ $asistencias->where('asistencia', 1)->count() }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h5 class="card-title">Ausencias</h5>
                                <h2>{{ $asistencias->where('asistencia', 0)->count() }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

