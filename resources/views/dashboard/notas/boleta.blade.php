@extends('layouts.app')

@section('title', 'Boleta de Notas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            Boleta de Notas - {{ $usuario->namefull }}
        </h1>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" height="80" onerror="this.src='{{ asset('img/logo.png') }}'">
                <h3>{{ $config->colegio }}</h3>
                <h5>Boleta de Calificaciones</h5>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Estudiante:</strong> {{ $usuario->namefull }}<br>
                    <strong>Cédula:</strong> {{ $usuario->cedula }}<br>
                </div>
                <div class="col-md-6">
                    <strong>Curso:</strong> {{ $usuario->curso->seccion ?? '-' }}<br>
                    <strong>Fecha:</strong> {{ now()->format('d/m/Y') }}
                </div>
            </div>

            @php
                $notasPorMateria = $notas->groupBy('idMa');
            @endphp

            @foreach($notasPorMateria as $materiaId => $notasMateria)
                @php
                    $materia = $notasMateria->first()->materia;
                    $notasPorLapso = $notasMateria->groupBy('lapso');
                @endphp

                <div class="mb-4">
                    <h5 class="bg-primary text-white p-2">{{ $materia->materia }}</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="table-secondary">
                                    <th>Lapso</th>
                                    <th>Eval 1</th>
                                    <th>Eval 2</th>
                                    <th>Eval 3</th>
                                    <th>Eval 4</th>
                                    <th>Adicionales</th>
                                    <th>Promedio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notasPorLapso as $lapso => $notasLapso)
                                    @foreach($notasLapso as $nota)
                                        <tr>
                                            <td>{{ $lapso }}</td>
                                            <td>{{ $nota->eval1 ?? '-' }}</td>
                                            <td>{{ $nota->eval2 ?? '-' }}</td>
                                            <td>{{ $nota->eval3 ?? '-' }}</td>
                                            <td>{{ $nota->eval4 ?? '-' }}</td>
                                            <td>{{ $nota->adicionales ?? '-' }}</td>
                                            <td><strong>{{ number_format($nota->promedio, 2) }}</strong></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            @if($notas->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay notas registradas para este estudiante.
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

