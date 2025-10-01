@extends('layouts.app')

@section('title', 'Tareas Enviadas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Tareas Enviadas - {{ $materia->materia }}
        </h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Entregas de Estudiantes ({{ $tareasEnviadas->count() }})</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha de Envío</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tareasEnviadas as $tareaEnviada)
                            <tr>
                                <td><strong>{{ $tareaEnviada->nombre }}</strong></td>
                                <td>{{ $tareaEnviada->descripcion }}</td>
                                <td>{{ $tareaEnviada->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ asset('storage/tareas/estudiantes/' . $tareaEnviada->ruta) }}" 
                                       target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay tareas enviadas aún</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

