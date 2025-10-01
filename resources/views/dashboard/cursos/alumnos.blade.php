@extends('layouts.app')

@section('title', 'Estudiantes - ' . $curso->seccion)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('cursos.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Estudiantes - {{ $curso->seccion }}
        </h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Lista de Estudiantes ({{ $curso->alumnos->count() }})</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($curso->alumnos as $index => $alumno)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $alumno->namefull }}</td>
                                <td>{{ $alumno->cedula }}</td>
                                <td>{{ $alumno->correo }}</td>
                                <td>{{ $alumno->telefono ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('usuarios.show', $alumno) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay estudiantes en este curso</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

