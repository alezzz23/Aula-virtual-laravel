@extends('layouts.app')

@section('title', 'Asistencia - ' . $curso->seccion)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('asistencia.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Asistencia - {{ $curso->seccion }}
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materias as $materia)
                            <tr>
                                <td>{{ $materia->materia }}</td>
                                <td>{{ $materia->profesor->namefull ?? 'Sin asignar' }}</td>
                                <td>
                                    <a href="{{ route('asistencia.materia', $materia) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-clipboard-check"></i> Registrar
                                    </a>
                                    <a href="{{ route('asistencia.ver', $materia) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver Registros
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <span class="text-muted">No hay materias disponibles para este curso.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

