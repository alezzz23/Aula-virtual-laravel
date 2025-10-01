@extends('layouts.app')

@section('title', 'Certificado de Notas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('usuarios.show', $estudiante) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Evaluación Completa - {{ $estudiante->namefull }}
        </h1>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>

    <!-- Información del estudiante -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Información del Estudiante</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre Completo:</strong> {{ $estudiante->namefull }}</p>
                    <p><strong>Cédula:</strong> {{ $estudiante->cedula }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Sección Actual:</strong> {{ $estudiante->curso->seccion ?? '-' }}</p>
                    <p><strong>Estado:</strong> 
                        @if($estudiante->estado)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Historial de notas por curso y periodo -->
    @foreach($historial as $periodo => $cursos)
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">{{ $periodo }}</h5>
            </div>
            <div class="card-body">
                @foreach($cursos as $curso => $notas)
                    <h6 class="mb-3"><strong>Curso:</strong> {{ $curso }}</h6>
                    
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Materia</th>
                                    <th class="text-center">1er Lapso</th>
                                    <th class="text-center">2do Lapso</th>
                                    <th class="text-center">3er Lapso</th>
                                    <th class="text-center">Definitiva</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $materias = [];
                                    foreach($notas as $nota) {
                                        $materias[$nota->materia][$nota->lapso] = $nota->total;
                                    }
                                @endphp

                                @foreach($materias as $materia => $lapsos)
                                    @php
                                        $nota1 = $lapsos['1er Lapso'] ?? 0;
                                        $nota2 = $lapsos['2do Lapso'] ?? 0;
                                        $nota3 = $lapsos['3er Lapso'] ?? 0;
                                        $definitiva = $nota1 && $nota2 && $nota3 ? 
                                            round(($nota1 + $nota2 + $nota3) / 3, 2) : 0;
                                        $rowClass = $definitiva < 10 ? 'table-danger' : '';
                                    @endphp
                                    <tr class="{{ $rowClass }}">
                                        <td>{{ $materia }}</td>
                                        <td class="text-center">{{ $nota1 ?: '-' }}</td>
                                        <td class="text-center">{{ $nota2 ?: '-' }}</td>
                                        <td class="text-center">{{ $nota3 ?: '-' }}</td>
                                        <td class="text-center"><strong>{{ $definitiva ?: '-' }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if(count($historial) == 0)
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No hay notas registradas para este estudiante.
        </div>
    @endif
</div>

<style>
    @media print {
        .btn, nav, .sidebar { display: none !important; }
        body { background: white !important; }
    }
</style>
@endsection

