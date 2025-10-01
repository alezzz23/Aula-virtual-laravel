@extends('layouts.app')

@section('title', 'Reporte de Asistencias Totales')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('asistencia.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            <i class="fas fa-clipboard-list"></i> Reporte de Asistencias Totales
        </h1>
    </div>

    <!-- Filtros -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0"><i class="fas fa-filter"></i> Filtros</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('asistencia.total') }}">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="fecha" class="form-label">Filtrar por fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" 
                               value="{{ request('fecha') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="seccion" class="form-label">Filtrar por sección:</label>
                        <select id="seccion" name="seccion" class="form-select">
                            <option value="">Todas las secciones</option>
                            @foreach($secciones as $seccion)
                                <option value="{{ $seccion->seccion }}" {{ request('seccion') == $seccion->seccion ? 'selected' : '' }}>
                                    {{ $seccion->seccion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Filtrar
                        </button>
                        <a href="{{ route('asistencia.total') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-broom"></i> Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resumen estadístico -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-check-circle"></i> Presentes</h5>
                    <h3>{{ $estadisticas['presentes'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-times-circle"></i> Ausentes</h5>
                    <h3>{{ $estadisticas['ausentes'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-circle"></i> Justificados</h5>
                    <h3>{{ $estadisticas['justificados'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-clock"></i> Tardanzas</h5>
                    <h3>{{ $estadisticas['tardanzas'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de asistencias -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detalle de Asistencias</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Estudiante</th>
                            <th>Sección</th>
                            <th>Estado</th>
                            <th>Comentario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asistencias as $asistencia)
                            <tr>
                                <td>{{ $asistencia->fecha ? \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') : '-' }}</td>
                                <td>{{ $asistencia->usuario->namefull ?? '-' }}</td>
                                <td>{{ $asistencia->curso->seccion ?? '-' }}</td>
                                <td>
                                    @if($asistencia->presente)
                                        <span class="badge bg-success">Presente</span>
                                    @elseif($asistencia->justificado)
                                        <span class="badge bg-warning">Justificado</span>
                                    @elseif($asistencia->tardanza)
                                        <span class="badge bg-info">Tardanza</span>
                                    @else
                                        <span class="badge bg-danger">Ausente</span>
                                    @endif
                                </td>
                                <td>{{ $asistencia->comentario ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No se encontraron registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $asistencias->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

