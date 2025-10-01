@extends('layouts.app')

@section('title', 'Registro de Notas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('notas.curso', $materia->cursoRelacion) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            {{ $materia->materia }} - {{ $materia->curso->seccion }}
        </h1>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Registro de Notas</h5>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar estudiante...">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Estudiante</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaAlumnos">
                        @forelse($alumnos as $index => $alumno)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $alumno->namefull }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#notasModal{{ $alumno->id }}">
                                        <i class="fas fa-edit"></i> Gestionar Notas
                                    </button>
                                    <a href="{{ route('usuarios.boleta', $alumno) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Boleta
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal para Notas -->
                            <div class="modal fade" id="notasModal{{ $alumno->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Notas de {{ $alumno->namefull }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('notas.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="alumno" value="{{ $alumno->id }}">
                                                <input type="hidden" name="idMa" value="{{ $materia->id }}">

                                                <div class="mb-3">
                                                    <label class="form-label">Período *</label>
                                                    <select class="form-select" name="idPe" required>
                                                        <option value="">Seleccione período...</option>
                                                        @foreach($periodos as $periodo)
                                                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Lapso *</label>
                                                    <select class="form-select" name="lapso" required>
                                                        <option value="1er Lapso">1er Lapso</option>
                                                        <option value="2do Lapso">2do Lapso</option>
                                                        <option value="3er Lapso">3er Lapso</option>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Eval 1</label>
                                                            <input type="number" class="form-control" name="eval1" min="0" max="20" step="0.01">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Eval 2</label>
                                                            <input type="number" class="form-control" name="eval2" min="0" max="20" step="0.01">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Eval 3</label>
                                                            <input type="number" class="form-control" name="eval3" min="0" max="20" step="0.01">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label">Eval 4</label>
                                                            <input type="number" class="form-control" name="eval4" min="0" max="20" step="0.01">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Evaluaciones Adicionales (separadas por comas)</label>
                                                    <input type="text" class="form-control" name="adicionales" placeholder="15, 18, 20">
                                                    <small class="text-muted">Ejemplo: 15, 18, 20</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar Notas</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay estudiantes en este curso</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('buscar').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaAlumnos tr');

        rows.forEach(function(row) {
            var nombre = row.cells[1]?.textContent.toLowerCase() || '';
            row.style.display = nombre.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection

