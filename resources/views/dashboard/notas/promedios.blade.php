@extends('layouts.app')

@section('title', 'Promedios')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('notas.curso', $curso) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Promedios - {{ $curso->seccion }} - {{ $periodo->periodo }}
        </h1>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="table-primary">
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Estudiante</th>
                            @foreach($materias as $materia)
                                <th colspan="3" class="text-center">{{ $materia->materia }}</th>
                            @endforeach
                            <th rowspan="2">Promedio General</th>
                        </tr>
                        <tr>
                            @foreach($materias as $materia)
                                <th>1er</th>
                                <th>2do</th>
                                <th>3er</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $index => $alumno)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $alumno->namefull }}</td>
                                @php
                                    $sumaPromedios = 0;
                                    $contadorMaterias = 0;
                                @endphp
                                @foreach($materias as $materia)
                                    @php
                                        $notasMateria = $notas->where('alumno', $alumno->id)
                                                             ->where('idMa', $materia->id)
                                                             ->where('idPe', $periodo->id);
                                        
                                        $nota1 = $notasMateria->where('lapso', '1er Lapso')->first();
                                        $nota2 = $notasMateria->where('lapso', '2do Lapso')->first();
                                        $nota3 = $notasMateria->where('lapso', '3er Lapso')->first();
                                        
                                        $promedio1 = $nota1->promedio ?? 0;
                                        $promedio2 = $nota2->promedio ?? 0;
                                        $promedio3 = $nota3->promedio ?? 0;
                                        
                                        $promedioMateria = ($promedio1 + $promedio2 + $promedio3) / 3;
                                        if ($promedioMateria > 0) {
                                            $sumaPromedios += $promedioMateria;
                                            $contadorMaterias++;
                                        }
                                    @endphp
                                    <td class="{{ $promedio1 < 10 ? 'table-danger' : '' }}">
                                        {{ $promedio1 > 0 ? number_format($promedio1, 2) : '-' }}
                                    </td>
                                    <td class="{{ $promedio2 < 10 ? 'table-danger' : '' }}">
                                        {{ $promedio2 > 0 ? number_format($promedio2, 2) : '-' }}
                                    </td>
                                    <td class="{{ $promedio3 < 10 ? 'table-danger' : '' }}">
                                        {{ $promedio3 > 0 ? number_format($promedio3, 2) : '-' }}
                                    </td>
                                @endforeach
                                <td class="table-info">
                                    <strong>
                                        {{ $contadorMaterias > 0 ? number_format($sumaPromedios / $contadorMaterias, 2) : '-' }}
                                    </strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style media="print">
    .btn, nav, .sidebar { display: none !important; }
    body { background: white !important; }
</style>
@endsection

