@extends('layouts.app')

@section('title', 'Alumnos Deficientes')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('notas.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Alumnos Deficientes - {{ $curso->seccion }}
        </h1>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>

    <div class="card">
        <div class="card-header bg-warning">
            <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Estudiantes con Notas Deficientes (< 10)</h5>
        </div>
        <div class="card-body">
            @if($notasDeficientes->isEmpty())
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> ¡Excelente! No hay estudiantes con notas deficientes en este curso.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>Estudiante</th>
                                <th>Materia</th>
                                <th>Lapso</th>
                                <th>Promedio</th>
                                <th>Período</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notasDeficientes as $nota)
                                <tr>
                                    <td>{{ $nota->usuario->namefull }}</td>
                                    <td>{{ $nota->materia->materia }}</td>
                                    <td>{{ $nota->lapso }}</td>
                                    <td class="table-danger">
                                        <strong>{{ number_format($nota->promedio, 2) }}</strong>
                                    </td>
                                    <td>{{ $nota->periodo->periodo ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <div class="alert alert-info">
                        <strong>Total de notas deficientes:</strong> {{ $notasDeficientes->count() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style media="print">
    .btn, nav, .sidebar { display: none !important; }
    body { background: white !important; }
</style>
@endsection

