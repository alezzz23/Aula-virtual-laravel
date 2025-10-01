@extends('layouts.app')

@section('title', 'Notas - ' . $curso->seccion)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('notas.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Notas - {{ $curso->seccion }}
        </h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Materias del Curso</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Estudiantes</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materias as $materia)
                            <tr>
                                <td>{{ $materia->materia }}</td>
                                <td>{{ $materia->profesor->namefull ?? 'Sin asignar' }}</td>
                                <td>{{ $curso->alumnos->count() }}</td>
                                <td>
                                    <a href="{{ route('notas.materia', $materia) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i> Registrar Notas
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <span class="text-muted">No hay materias disponibles para este curso.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Promedios por Período -->
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Ver Promedios por Período</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('notas.promedios', ['curso' => $curso->id, 'periodo' => 0]) }}" method="GET" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Seleccione el Período</label>
                    <select class="form-select" name="periodo" required>
                        <option value="">Seleccione...</option>
                        @foreach($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-chart-bar"></i> Ver Promedios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

