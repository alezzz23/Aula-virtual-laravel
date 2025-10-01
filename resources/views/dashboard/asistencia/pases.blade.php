@extends('layouts.app')

@section('title', 'Resumen de Pases')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('asistencia.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Resumen de Observaciones - Pases
        </h1>
    </div>

    <!-- Formulario de búsqueda -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('asistencia.pases') }}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="buscar" name="buscar" class="form-control" 
                               placeholder="Ingrese nombre o sección" value="{{ request('buscar') }}">
                    </div>
                    <div class="col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="{{ route('asistencia.pases') }}" class="btn btn-secondary">Limpiar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Pases del Mes: {{ now()->format('F Y') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            <th>Sección</th>
                            <th>Cantidad de pases</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pases as $pase)
                            <tr>
                                <td>{{ $pase->alumno }}</td>
                                <td>{{ $pase->seccion }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $pase->observaciones_count }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    No se encontraron registros de pases para el mes actual
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pases->count() > 0)
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i>
                    <strong>Total de estudiantes con pases:</strong> {{ $pases->count() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

