@extends('layouts.app')

@section('title', 'Registro de Asistencia')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('asistencia.curso', $materia->cursoRelacion) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $materia->materia }} - Registro de Asistencia
        </h1>
        <a href="{{ route('asistencia.ver', $materia) }}" class="btn btn-info">
            <i class="fas fa-eye"></i> Ver Registros
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('asistencia.store') }}" method="POST" id="formAsistencia">
                @csrf
                <input type="hidden" name="materia_id" value="{{ $materia->id }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="registro" class="form-label">Número de Registro</label>
                        <input type="number" class="form-control" name="registro" id="registro" 
                               value="{{ $ultimoRegistro + 1 }}" min="1" readonly>
                        <small class="text-muted">Registro automático</small>
                    </div>
                    <div class="col-md-6">
                        <label for="buscar" class="form-label">Buscar Estudiante</label>
                        <input type="text" class="form-control" id="buscar" placeholder="Buscar por nombre...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Estudiante</th>
                                <th>Asistencia</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAlumnos">
                            @foreach($alumnos as $index => $alumno)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $alumno->namefull }}</td>
                                    <td>
                                        <input type="hidden" name="alumnos[{{ $index }}][usuario_id]" value="{{ $alumno->id }}">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" 
                                                   name="alumnos[{{ $index }}][asistencia]" 
                                                   id="presente_{{ $alumno->id }}" 
                                                   value="1" required>
                                            <label class="btn btn-outline-success" for="presente_{{ $alumno->id }}">
                                                <i class="fas fa-check"></i> Presente
                                            </label>

                                            <input type="radio" class="btn-check" 
                                                   name="alumnos[{{ $index }}][asistencia]" 
                                                   id="ausente_{{ $alumno->id }}" 
                                                   value="0">
                                            <label class="btn btn-outline-danger" for="ausente_{{ $alumno->id }}">
                                                <i class="fas fa-times"></i> Ausente
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" 
                                               name="alumnos[{{ $index }}][comentario]" 
                                               placeholder="Comentario opcional">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Asistencia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('buscar').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaAlumnos tr');

        rows.forEach(function(row) {
            var nombre = row.cells[1].textContent.toLowerCase();
            row.style.display = nombre.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection

